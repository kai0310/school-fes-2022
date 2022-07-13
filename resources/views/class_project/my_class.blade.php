<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $schoolClass->classProject->name ?? __('Unknown') }} {{ __('Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if($schoolClass->classProject)

                        <div class="bg-white">
                            <div class="pt-6 md:flex">

                                <!-- Image gallery -->
                                <div class="mt-6 max-w-2xl mx-auto sm:px-6">

                                    <div class="aspect-w-3 aspect-h-3 max-w-3x sm:rounded-lg sm:overflow-hidden">
                                        <img
                                            src=""
                                            alt="{{ __(':0の写真', [$schoolClass->classProject->name]) }}"
                                            class="w-full h-full max-h-96 md:max-h-fit object-center object-cover"
                                        />
                                    </div>
                                </div>

                                <div class="max-w-2xl mx-auto pt-10 pb-16 px-4 sm:px-6">
                                    <div class="lg:col-span-2 lg:pr-8">
                                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                                            {{ $schoolClass->classProject->name }}
                                        </h1>
                                    </div>

                                    <div class="py-10 lg:pt-6 lg:pb-16 lg:col-start-1 lg:col-span-2 lg:pr-8">
                                        <div>
                                            <h3 class="sr-only">Description</h3>

                                            <div class="space-y-6">
                                                <p class="text-base text-gray-900">
                                                    {{ $schoolClass->classProject->detail }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="inline-block mt-10 flex gap-2 flex-wrap">

                                            @if($schoolClass->classProject->place)
                                                <div
                                                    class="bg-yellow-400 text-white flex inline-block items-center py-2 rounded-full flex-none font-bold px-4 gap-x-1">
                                                    <x-twemoji emoij="🚪"/>
                                                    <span class="text-sm">
                                                        {{ __(':0 で行なっています', [$schoolClass->classProject->place]) }}
                                                    </span>
                                                </div>
                                            @endif

                                            @if($schoolClass->classProject->paid_planning)

                                                <div
                                                    class="bg-blue-300 text-white flex inline-block items-center py-2 rounded-full flex-none font-bold px-4 gap-x-1">
                                                    <x-twemoji emoij="💰"/>
                                                    <span class="text-sm">
                                                        お金が必要です
                                                    </span>
                                                </div>
                                            @else

                                                <div
                                                    class="bg-blue-300 text-white flex inline-block items-center py-2 rounded-full flex-none font-bold px-4 gap-x-1">
                                                    <x-twemoji emoij="🎁"/>
                                                    <span class="text-sm">
                                                        無料でお楽しみいただけます
                                                    </span>
                                                </div>
                                            @endif

                                            @if($schoolClass->classProject->isAttraction())
                                                <div class="bg-red-400 text-white flex inline-block items-center py-2 rounded-full flex-none font-bold px-4 gap-x-1">
                                                    <x-twemoji emoij="🎮"/>
                                                    <span class="text-sm">
                                                        体験型
                                                    </span>
                                                </div>
                                            @else
                                                <div class="bg-indigo-400 text-white flex inline-block items-center py-2 rounded-full flex-none font-bold px-4 gap-x-1">
                                                    <x-twemoji emoij="🍿"/>
                                                    <span class="text-sm">
                                                    劇・発表
                                                </span>
                                                </div>
                                            @endif

                                            @if($schoolClass->classProject->provide_meals)
                                                <div class="bg-green-400 text-white flex inline-block items-center py-2 rounded-full flex-none font-bold px-4 gap-x-1">
                                                    <x-twemoji emoij="🧃"/>
                                                    <span class="text-sm">
                                                        飲食提供をしています
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mt-10">
                                            <h3 class="text-sm font-medium text-gray-900 flex items-center">
                                                <x-twemoji emoij="😷" class="mr-5"/>
                                                <x-twemoji emoij="✨" class="mr-5"/>
                                                <span class="ml-1">
                                                    {{ __('私たちは、以下の感染対策を行なっています') }}
                                                </span>
                                            </h3>

                                            <div class="mt-4">
                                                <p class="text-sm text-gray-600">
                                                    {{ $schoolClass->classProject->infection_control }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
