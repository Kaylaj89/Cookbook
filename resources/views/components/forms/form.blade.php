<div class="grid  gap-6 ">
    <div class="mt-5 md:mt-0 md:col-span-2">
        <x-buk-form action="{{$action}}" method="{{$method}}" enctype="multipart/form-data">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    {{$slot}}
                </div>
            </div>
        </x-buk-form>
    </div>
</div>