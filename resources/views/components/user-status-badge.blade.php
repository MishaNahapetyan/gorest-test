@props(['status'])

<span @class([
        'bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900' => $status == 'inactive',
        'bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900' => $status == 'active',
    ])>{{ str($status)->ucfirst() }}</span>
