<section class="space-y-6">
    <div class="profile-picture">
        @if($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
        @else
            <img src="{{ asset('default-profile.png') }}" alt="Default Profile Picture" class="rounded-full w-32 h-32">
        @endif
    </div>
    

    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-picture-update')"
    >{{ __('Update Picture') }}</x-primary-button>

    <x-modal name="confirm-picture-update" :show="$errors->pictureUpdate->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.picture.update') }}" enctype="multipart/form-data" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Update Profile Picture') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Choose an image file to update your profile picture.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="picture" value="{{ __('Choose Picture') }}" class="sr-only" />

                <x-text-input
                    id="picture"
                    name="picture"
                    type="file"
                    class="mt-1 block w-3/4"
                    accept="image/*"
                />

                <x-input-error :messages="$errors->pictureUpdate->get('picture')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Update Picture') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</section>
