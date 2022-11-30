<?php

namespace App\Service;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Api
{
    protected string $apiUrl;

    protected string $token;

    protected int | string $totalNumberOfResults = 0;

    protected int | string $totalNumberOfPages = 0;

    protected int | string $currentPage = 1;

    protected int | string $resultsPerPage = 0;

    public function __construct() {
        $this->apiUrl = config('app.api_url');
        $this->token = config('app.api_token');
    }

    public static function call(): static
    {
        return new static();
    }

    protected function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    public function getTotalNumberOfResults(): int | string
    {
        return $this->totalNumberOfResults;
    }

    public function getTotalNumberOfPages(): int | string
    {
        return $this->totalNumberOfPages;
    }

    public function getCurrentPage(): int | string
    {
        return $this->currentPage;
    }

    public function getResultsPerPage(): int | string
    {
        return $this->resultsPerPage;
    }

    public function getNextPage(): int
    {
        return $this->currentPage + 1;
    }

    public function hasNextPage(): bool
    {
        return $this->getTotalNumberOfPages() >= $this->getCurrentPage();
    }

    public function hasPreviousPage(): bool
    {
        return $this->getCurrentPage() > 1;
    }

    protected function http(): PendingRequest
    {
        return Http::withToken($this->token);
    }

    protected function listUserUrl(null | int $page = 1): string
    {
        $checkStatus = Auth::user()->isManager() ? '&status=active' : '';

        return 'public/v2/users?page='.$page.$checkStatus;
    }

    protected function listUserPosts(int $userID): string
    {
        return "public/v2/users/{$userID}/posts";
    }

    protected function listPostComments(int $postID): string
    {
        return "/public/v2/posts/{$postID}/comments";
    }

    public function getUsers(null | int $page = 1): array
    {
        $response = $this->http()->get($this->getApiUrl().$this->listUserUrl($page));

        return $this->result($response);
    }

    public function getPosts(int $userID): array
    {
        $response = $this->http()->get($this->getApiUrl().$this->listUserPosts($userID));

        return $this->result($response);
    }

    public function getPostComments(int $postID): array
    {
        $response = $this->http()->get($this->getApiUrl().$this->listPostComments($postID));

        return $this->result($response);
    }

    protected function preparePagination(array $headers): void
    {
        $this->totalNumberOfResults = $headers['x-pagination-total'][0] ?? 0;
        $this->totalNumberOfPages = $headers['x-pagination-pages'][0] ?? 0;
        $this->currentPage = $headers['x-pagination-page'][0] ?? 0;
        $this->resultsPerPage = $headers['x-pagination-limit'][0] ?? 0;
    }

    protected function getPagination(): array
    {
        return [
            'total' => $this->getTotalNumberOfResults(),
            'pages' => $this->getTotalNumberOfPages(),
            'page' => $this->getCurrentPage(),
            'limit' => $this->getResultsPerPage(),
            'next_page' => $this->getNextPage(),
            'previous_page' => $this->getCurrentPage() - 1,
            'has_previous_page' => $this->hasPreviousPage(),
            'has_next_page' => $this->hasNextPage(),
        ];
    }

    protected function result(Response $response): array
    {
        if ($response->status() !== 200) {
            return [];
        }

        $this->preparePagination($response->headers());

        return [
            ...['data' => $response->collect()->toArray()],
            ...$this->getPagination()
        ];
    }
}
