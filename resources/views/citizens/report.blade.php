<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>

    <style>
        @page {
            size: landscape;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

</head>
<body>
    <div class="mb-4 flex items-center justify-between">
        <h1
            class="text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
            CITIZENS TABLE
        </h1>        
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-3 py-1">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Surname
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Forename
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Midname
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Suffix
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Birthdate
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Gender
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Vicinity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Barangay
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citizen as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->surname }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->forename }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->midname }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->suffix }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->birthdate }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->gender->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->vicinity }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->barangay }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</body>
</html>
