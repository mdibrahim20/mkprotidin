

<button id="toggleSidebar" class="md:hidden fixed top-4 left-4 z-50 bg-gray-800 text-white p-2 rounded">
    &#x22EE;
</button>
<aside id="sidebar" class="w-64 bg-gray-800 text-white p-6 fixed inset-y-0 left-0 z-40 transition-all duration-300 ease-in-out -ml-64 md:ml-0">
    <nav class="bg-gray-800 text-white p-4">
        <ul>
            <li class="mb-4">
                <a href="{{ route('dashboard') }}" 
                    class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
                    Dashboard
                </a>
            </li>
            <li class="mb-4">
                <a href="{{ route('admin.articles.index') }}" 
                    class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.articles.index') ? 'bg-gray-700' : '' }}">
                    Articles
                </a>
            </li>
            @if(auth()->user() && auth()->user()->isAdmin())  
            <li class="mb-4">
                <a href="{{ route('admin.categories.index') }}" 
                    class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.categories.index') ? 'bg-gray-700' : '' }}">
                    Categories
                </a>
            </li>
            <li class="mb-4">
                <a href="{{ route('admin.seo.index') }}" 
                    class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.seo.index') ? 'bg-gray-700' : '' }}">
                    SEO Settings
                </a>
            </li>
            <li class="mb-4">
                <a href="{{ route('admin.ads.index') }}" 
                    class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.ads.index') ? 'bg-gray-700' : '' }}">
                    Manage Ads
                </a>
            </li>
            <li class="mb-4">
                <a href="{{ route('admin.comments.index') }}" 
                    class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.comments.index') ? 'bg-gray-700' : '' }}">
                    Comments
                </a>
            </li>
    
            <!-- ✅ Users Route - Only for Admin -->
            
                <li class="mb-4">
                    <a href="{{ route('admin.users.index') }}" 
                        class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.users.index') ? 'bg-gray-700' : '' }}">
                        Users
                    </a>
                </li>
           
            
            <!-- ✅ Galleries Section -->
            <li class="mb-4">
                <a href="{{ route('admin.gallery.index') }}" 
                    class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.gallery.index') ? 'bg-gray-700' : '' }}">
                    Galleries
                </a>
            </li>
            <li class="mb-4">
                <a href="{{ route('admin.video-gallery.index') }}" 
                    class="block py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.video-gallery.index') ? 'bg-gray-700' : '' }}">
                    Video Gallery
                </a>
            </li>
            @endif
            <!-- ✅ Logout -->
            <li class="mb-4">
                <a href="{{ route('logout') }}" class="block py-2 px-4 rounded hover:bg-gray-700"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</aside>
<script>
     document.addEventListener('DOMContentLoaded', () => {
            const toggleButton = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('sidebar');
            let isSidebarOpen = false;

            if (toggleButton && sidebar) {
                toggleButton.addEventListener('click', () => {
                    if (isSidebarOpen) {
                        sidebar.classList.add('-ml-64');
                        sidebar.classList.remove('ml-0');
                    } else {
                        sidebar.classList.remove('-ml-64');
                        sidebar.classList.add('ml-0');
                    }
                    isSidebarOpen = !isSidebarOpen;
                });
            }
        });
</script>
