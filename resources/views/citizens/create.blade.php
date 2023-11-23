@extends('layouts.KKP')

@section('citizenCreate')
<div class="py-8 px-5 mx-auto max-w-2xl">
    <h2 class="mb-4 text-xl font-bold text-red-900">Add Citizen</h2>
    <form method="post" action="#" enctype="multipart/form-data">
        @csrf
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div class="sm:col-span-2">
                <label for="surname"
                    class="block mb-2 text-sm font-medium text-gray-900">Surname</label>
                <input type="text" name="surname" id="surname"
                    @if ($errors->has('surname')) class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500" placeholder={{ old('surname') }}>
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">{{ $errors->first('surname') }}</p>
                    @else
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ old('surname') }}"> @endif
                    </div>

            <div class="sm:col-span-2">
                <label for="forename"
                    class="block mb-2 text-sm font-medium text-gray-900">Forename</label>
                <input type="text" name="forename" id="forename"
                    @if ($errors->has('forename')) class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500" placeholder={{ old('forename') }}>
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">{{ $errors->first('forename') }}</p>
                    @else
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ old('forename') }}"> @endif
            </div>

            <div class="sm:col-span-2">
                <label for="midname"
                    class="block mb-2 text-sm font-medium text-gray-900">Midname</label>
                <input type="text" name="midname" id="midname"
                    @if ($errors->has('midname')) 
                        class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500" placeholder={{ old('midname') }}>
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">{{ $errors->first('midname') }}</p>
                    @else
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ old('midname') }}"> @endif
            </div>

            <div class="sm:col-span-2">
                <label for="suffix"
                    class="block mb-2 text-sm font-medium text-gray-900">
                    Suffix
                </label>
                <input type="text" name="suffix" id="suffix"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="">
            </div>

            <div class="w-full">
                <label for="birthdate"
                    class="block mb-2 text-sm font-medium text-gray-900">
                    Birthdate
                </label>
                <input type="date" name="birthdate" id="birthdate"
                    @if ($errors->has('birthdate')) 
                        class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500" placeholder="Error input">
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">{{ $errors->first('birthdate') }}</p>
                    @else
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ old('birthdate') }}" format='yyyy-mm-dd'> @endif
            </div>

            <!--Gender -->
            <div class="w-full">
                <label for="gender_id"
                    class="block mb-2 text-sm font-medium text-gray-900">
                    Gender
                </label>
                <select id="gender" name="gender_id"
                    @if ($errors->has('gender_id')) 
                        class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 font-medium">
                    @else
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @endif
                    <option selected="">Select category</option>
                        @foreach ($gender as $item)
                        <option value={{ $item->id }}
                            {{ old('gender_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                        </option>
                        @endforeach
                </select>
                    @if ($errors->has('gender_id'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">The gender field is required.</p>
                    @endif
            </div>

            <!--Vicinity -->
            <div class="sm:col-span-2">
                <label for="vicinity"
                    class="block mb-2 text-sm font-medium text-gray-900">
                    Vicinity
                </label>
                <input type="vicinity" name="vicinity" id="vicinity"
                    @if ($errors->has('vicinity')) 
                        class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500">
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">{{ $errors->first('vicinity') }}</p>
                    @else
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ old('vicinity') }}"> @endif
            </div>

            <!--Barangay -->
            <div class="sm:col-span-2">
                <label for="barangay_id"
                    class="block mb-2 text-sm font-medium text-gray-900">
                    Barangay
                </label>
                <select id="barangay_id" name="barangay_id"
                    @if ($errors->has('barangay_id')) 
                    class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 font-medium">
                    @else
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @endif
                    <option selected="">Select Barangay</option>
                        @foreach ($barangay as $item)
                        <option value={{ $item }}{{ old('barangay_id') == $item ? 'selected' : '' }}>
                            {{ $item }}</option>
                        @endforeach
                </select>
                    @if ($errors->has('barangay_id'))
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">
                        The barangay field is required.</p>
                    @endif
            </div>

            <!--Live Status -->
            <div class="sm:col-span-2">
                <label for="livelihood_status_id"
                    class="block mb-2 text-sm font-medium text-gray-900">
                    Livelihood Status
                </label>
                <select id="livelihood_status_id" name="livelihood_status_id"
                    @if ($errors->has('livelihood_status_id')) 
                    class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 font-medium">
                    @else
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @endif
                    <option selected="">Select Status</option>
                        @foreach ($liveStatus as $item)
                        <option value={{ $item->id }}{{ old('livelihood_status_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                        @endforeach
                </select>
                    @if ($errors->has('livelihood_status_id'))
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">
                        The barangay field is required.</p>
                    @endif
            </div>

             <!--Family Income -->
             <div class="sm:col-span-2">
                <label for="family_income_range_id"
                    class="block mb-2 text-sm font-medium text-gray-900">
                    Family Income Range
                </label>
                <select id="family_income_range_id" name="family_income_range_id"
                    @if ($errors->has('family_income_range_id')) 
                    class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 font-medium">
                    @else
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @endif
                    <option selected="">Select Status</option>
                        @foreach ($familyIncome as $item)
                        <option value={{ $item->id }}{{ old('family_income_range_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                        @endforeach
                </select>
                    @if ($errors->has('family_income_range_id'))
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">
                        The barangay field is required.</p>
                    @endif
            </div>

             <!--Tenurial Status -->
             <div class="sm:col-span-2">
                <label for="tenurial_status_id"
                    class="block mb-2 text-sm font-medium text-gray-900">
                    Tenurial Status
                </label>
                <select id="tenurial_status_id" name="tenurial_status_id"
                    @if ($errors->has('tenurial_status_id')) 
                    class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 font-medium">
                    @else
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @endif
                    <option selected="">Select Status</option>
                        @foreach ($tenantStatus as $item)
                        <option value={{ $item->id }}{{ old('tenurial_status_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                        @endforeach
                </select>
                    @if ($errors->has('family_income_range_id'))
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">
                        The barangay field is required.</p>
                    @endif
            </div>

            <!--Avatar -->
            <div class="sm:col-span-2">
                <label for="avatar"
                    class="block mb-2 text-sm font-medium text-gray-900">
                    Avatar
                </label>
                <input type="file" name="avatar" id="avatar"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    accept="image/png, image/gif, image/jpeg"
                    @if ($errors->has('avatar')) 
                        class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500">
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">{{ $errors->first('avatar') }}</p>
                    @else
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @endif
            </div>
        </div>

        <div class="pt-5 flex justify-center">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Submit
            </button>
        </div>
    </form>
</div>
@endsection