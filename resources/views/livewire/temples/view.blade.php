<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Temples</h1>
      </div>
    </div>

    <div class="container px-4 mx-auto my-12 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    @if($templeInfo->photo != null)
                        <img alt="Placeholder" class="block w-full h-auto" src="{{ $templeInfo->photo }}">
                    @else
                        <img alt="Placeholder" class="block w-full h-auto" src="https://picsum.photos/600/400/?random">
                    @endif
                </div>
                <div>
                    <div class="flex flex-row">
                        <div>{{ $templeInfo->name }}</div>
                        <div>{{ $templeInfo->description }}</div>
                        <div>{{ $templeInfo->address }}</div>
                        <div>{{ $templeInfo->city }}</div>
                        <div>{{ $templeInfo->state }}</div>
                        <div>{{ $templeInfo->zipcode }}</div>
                    </div>
                </div>
              </div>
        </div>

    </div>

    <div class="max-w-6xl px-4 py-0 mx-auto ">

        <div
            x-data="{
            openTab: 1,
            activeClasses: 'active-tabi-setting',
            inactiveClasses: '',
            showHowToReach() {
                this.openTab = 1;
            },
            showTempleTimings() {
                this.openTab = 2;
            },
            showNearByPlaces() {
                this.openTab = 3;
            }
            }"
        >
            <ul class="flex flex-row flex-wrap mt-3 list-none new-tab-ul">
                <li @click="showHowToReach()" :class="{ '-mb-px': openTab === 1 }" class="flex-auto mr-2 -mb-px text-center last:mr-0">
                    <a :class="openTab === 1 ? activeClasses : inactiveClasses" class="block px-10 py-2 font-bold text-gray-700 rounded-md tabs-setting-sub fs-16" href="javascript:;">
                    How To Reach
                    </a>
                </li>
                <li @click="showTempleTimings()" :class="{ '-mb-px': openTab === 2 }" class="flex-auto mr-2 -mb-px text-center last:mr-0">
                    <a :class="openTab === 2 ? activeClasses : inactiveClasses" class="block px-10 py-2 font-bold text-gray-700 rounded-md tabs-setting-sub fs-16" href="javascript:;">Temple timings</a>
                </li>
                <li @click="showNearByPlaces()" :class="{ '-mb-px': openTab === 3 }" class="flex-auto mr-2 -mb-px text-center last:mr-0">
                    <a :class="openTab === 3 ? activeClasses : inactiveClasses" class="block px-10 py-2 font-bold text-gray-700 rounded-md tabs-setting-sub fs-16" href="javascript:;">Near By Places</a>
                </li>
            </ul>
            <div class="w-full pt-1">
                <div x-show="openTab === 1">
                    How To Reach
                </div>
                <div x-show="openTab === 2">
                    Temple Timings
                </div>
                <div x-show="openTab === 3">
                    Near By Places
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-xl mx-auto mt-10 ">
        <livewire:temple-comments :temple='$templeInfo'>
    </div>

</div>
