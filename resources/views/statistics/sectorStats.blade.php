@extends('layouts.KKP')


@section('SectorStats')
    <!--Header-->
    <div class="flex items-center justify-between p-1">
        <h1 class="text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6x">
            SECTOR TABLE
        </h1>
        <!-- drawer init and toggle -->
        <div>
            <a href="/report/sector"
                class="inline-flex text-white bg-red-700 hover:bg-red-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                type="button">
                <svg class="w-6 h-6 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 16 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 18a.969.969 0 0 0 .933 1h12.134A.97.97 0 0 0 15 18M1 7V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2v5M6 1v4a1 1 0 0 1-1 1H1m0 9v-5h1.5a1.5 1.5 0 1 1 0 3H1m12 2v-5h2m-2 3h2m-8-3v5h1.375A1.626 1.626 0 0 0 10 13.375v-1.75A1.626 1.626 0 0 0 8.375 10H7Z" />
                </svg>
            </a>
            <a href="/excel/sector"
                class="inline-flex text-white bg-blue-700 hover:bg-red-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                type="button">
                <svg class="w-6 h-6  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path d="M7 5V.13a2.96 2.96 0 0 0-1.293.749L2.879 3.707A2.96 2.96 0 0 0 2.13 5H7Z" />
                    <path
                        d="M19 7h-1.072A.989.989 0 0 0 18 6.639V2a1.97 1.97 0 0 0-1.933-2H9v5a2 2 0 0 1-2 2H1a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h1a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 18 18h1a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1Zm-9 1.828.961.02a1 1 0 0 1-.042 2l-.946-.02a.337.337 0 0 0-.339.3.317.317 0 0 0 .283.344l.537.059a2.543 2.543 0 0 1 1.887 1.1 2.207 2.207 0 0 1 .174 1.941A2.151 2.151 0 0 1 10.235 16H9.108a1 1 0 0 1 0-2h1.127a.936.936 0 0 0 .389-.047.439.439 0 0 0 .027-.251.62.62 0 0 0-.413-.18l-.537-.059a2.306 2.306 0 0 1-2.059-2.5A2.374 2.374 0 0 1 10 8.828Zm-8 4.525v-1.706A2.65 2.65 0 0 1 4.647 9h1.018a1 1 0 0 1 0 2H4.647a.647.647 0 0 0-.647.647v1.706a.647.647 0 0 0 .647.647h1.018a1 1 0 0 1 0 2H4.647A2.65 2.65 0 0 1 2 13.353Zm15.951-3.043-1.557 4.773a1 1 0 0 1-.951.689h-.011a1 1 0 0 1-.946-.71l-1.443-4.772a1 1 0 0 1 1.914-.58l.522 1.727.57-1.747a1 1 0 1 1 1.9.62h.002Z" />
                </svg>
            </a>
        </div>
    </div>

    <div class="overflow-x-auto sm:rounded-lg p-2">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-50 uppercase bg-gray-700 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Barangay
                    </th>
                    @foreach ($sector as $items)
                        <th scope="col" class="px-6 py-3">
                            {{ $items->name }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($barangays as $barangay)
                    <tr class="bg-gray-300 border-b dark:bg-gray-800 dark:border-gray-700">
                        <td>{{ $barangay }}</td>
                        @foreach ($sector as $gen)
                            <?php
                            $filtered = $countSector
                                ->where('barangay', $barangay)
                                ->where('sector_id', $gen->id)
                                ->first();
                            ?>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $filtered ? $filtered->count : 0 }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
