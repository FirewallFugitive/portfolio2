<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update About Me') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Share a little about yourself to personalize your profile.') }}
        </p>
    </header>

    <form method="post" action="{{ route('about.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="about_me" :value="__('About Me')" />
            <textarea id="about_me" name="about_me" rows="5" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring focus:ring-indigo-500 dark:focus:ring-indigo-600 sm:text-sm">
                {{ old('about_me', $user->about_me) }}
            </textarea>
            <x-input-error :messages="$errors->updateAboutMe->get('about_me')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'about-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
