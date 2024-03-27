<div class="w-full gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
    <div class="text-lg text-gray-600 leading-7 font-semibold dark:text-white">{{ __('Site Information') }}</div>
    <div>ID: {{ $site->id }}</div>
    <div>Name: {{ $site->name }}</div>
    <div>Directory: {{ $site->directory }}</div>
    <div>Status: {{ $site->status }}</div>
    <div>Repository Provider: {{ $site->repositoryProvider }}</div>
    <div>Repository: {{ $site->repository }}</div>
    <div>Repository Branch: {{ $site->repositoryBranch }}</div>
    <div>Quick Deploy: {{ $site->quickDeploy ? 'Enabled' : 'Disabled' }}</div>
</div>
