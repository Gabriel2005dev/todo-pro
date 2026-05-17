@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-700 dark:focus:border-purpler-700 focus:ring-purple-700 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>
