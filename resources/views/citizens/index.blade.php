@extends('layouts.KKP')

@section('citizenIndex')
    <!--Header-->
    <div class="flex items-center justify-between p-1">
        <h1 class="text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6x">
            CITIZENS TABLE
        </h1>
        <!-- drawer init and toggle -->
        <div>
            <button
                class="inline-flex text-white bg-green-700 hover:bg-green-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                type="button" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example"
                data-drawer-placement="right" aria-controls="drawer-right-example">
                <svg class="w-6 h-6 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 18">
                    <path
                        d="M18.85 1.1A1.99 1.99 0 0 0 17.063 0H2.937a2 2 0 0 0-1.566 3.242L6.99 9.868 7 14a1 1 0 0 0 .4.8l4 3A1 1 0 0 0 13 17l.01-7.134 5.66-6.676a1.99 1.99 0 0 0 .18-2.09Z" />
                </svg>
            </button>
            <a href="/report"
                class="inline-flex text-white bg-red-700 hover:bg-red-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                type="button">
                <svg class="w-6 h-6 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 16 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 18a.969.969 0 0 0 .933 1h12.134A.97.97 0 0 0 15 18M1 7V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2v5M6 1v4a1 1 0 0 1-1 1H1m0 9v-5h1.5a1.5 1.5 0 1 1 0 3H1m12 2v-5h2m-2 3h2m-8-3v5h1.375A1.626 1.626 0 0 0 10 13.375v-1.75A1.626 1.626 0 0 0 8.375 10H7Z" />
                </svg>
            </a>
<<<<<<< HEAD
            <a href="/excel/citizen"
                class="inline-flex text-white bg-green-700 hover:bg-green-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                type="button">
                <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                    <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
                    <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM12 6h-2v2h2v2h-2v2h2v2h-2v2h2v2h-2v-2H8v-2h2v-2H8v-2h2V8H8V6h2V4H8V2h2v2h2v2Z"/>
                  </svg>
            </a>
=======
>>>>>>> d8dac92f15055b8f790b9a17429b0e821c56cd3b
        </div>
    </div>

    <!--Table-->
    <div class="overflow-x-auto sm:rounded-lg p-2">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-50 uppercase bg-gray-700 dark:bg-gray-700 dark:text-gray-400">
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
                @foreach ($citizens as $item)          
                    <tr class="bg-gray-300 border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
    </div>

    <!-- ALERT SAMPLE -->
    <div>
        @if (isset($message))
            <div class="alert-red" role="alert">
                <span class="text-3xl font-bold">{{ $message }}</span>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    <div class="flex flex-col items-center mt-4">
        <span class="text-sm text-gray-700 dark:text-gray-400">
            Showing <span class="font-semibold text-gray-900">{{ $citizens->firstItem() }}</span> to <span
                class="font-semibold text-gray-900">{{ $citizens->lastItem() }}</span> of <span
                class="font-semibold text-gray-900">{{ $citizens->total() }}</span> Records
        </span>

        <div class="inline-flex mt-2 xs:mt-0">
            @if ($citizens->onFirstPage())
                <button
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-400 rounded-l-lg cursor-not-allowed">
                    Prev
                </button>
            @else
                <a href="{{ $citizens->previousPageUrl() }}"
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-l-lg hover:bg-gray-900">
                    Prev
                </a>
            @endif

            @if ($citizens->hasMorePages())
                <a href="{{ $citizens->nextPageUrl() }}"
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-r-lg border-0 border-s border-gray-700 hover:bg-gray-900">
                    Next
                </a>
            @else
                <button
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-400 border-0 border-s border-gray-700 rounded-r-lg cursor-not-allowed dark:bg-gray-800 dark:text-gray-400">
                    Next
                </button>
            @endif
        </div>

    </div>
    <!-- drawer component -->
    <div id="drawer-right-example"
        class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-right-label">

        <h5 id="drawer-right-label"
            class="inline-flex items-center mb-5 text-base font-bold text-gray-500 dark:text-gray-400">
            Actions
        </h5>

        <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>

        <!--QUICK SEARCH-->
        <form action="{{ route('citizens.index') }}" method="GET">
            <label for="quick-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">
                Search
            </label>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>

                <input type="search" id="quick-search"
                    class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Quick Search" name="quicksearch" required>
                <button type="submit"
                    class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>

        <!--FILTER SEARCH-->
        <form action="{{ route('citizens.index') }}" class="mb-6 pt-6" method="GET">
            <h5 id="drawer-right-label" class="items-center mb-5 text-base font-bold text-gray-500 dark:text-gray-400">
                Filter Search
            </h5>

            <div class="mb-6">
                <label for="birthdate"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthdate</label>
                <input type="date" name="birthdate" id="birthdate"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="" format="dd-mm-yyyy">
            </div>

            <div class="mb-6">
                <label for="gender_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                <select id="gender" name="gender_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option selected="" disabled>Select category</option>
                    @foreach ($gender as $item)
                        <option value={{ $item->id }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="barangay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Barangay
                </label>
                <select id="barangay" name="barangay"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option selected="" disabled>Select Barangay</option>
                    @foreach ($barangay as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 block">
                Filtered Search
            </button>
        </form>
    </div>
    </div>
    
@endsection
