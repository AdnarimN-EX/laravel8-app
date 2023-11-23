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
            GENDER TABLE
        </h1>        
    </div>
    
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Barangay
                    </th>
                    @foreach ($gender as $items)
                    <th scope="col" class="px-6 py-3">
                        {{$items->name}}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($barangays as $barangay)
                <tr class="bg-gray-300 border-b dark:bg-gray-800 dark:border-gray-700">
                    <td>{{ $barangay }}</td>
                    @foreach($gender as $gen)
                        <?php
                            $filtered = $countGender->where('barangay', $barangay)->where('gender_id', $gen->id)->first();
                        ?>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $filtered ? $filtered->count : 0 }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
</body>
</html>
