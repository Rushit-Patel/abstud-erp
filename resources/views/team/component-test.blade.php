{{-- Test view to demonstrate the component-based header --}}
<x-team.layout.app 
    title="Component Test"
    :breadcrumbs="[
        ['title' => 'Dashboard', 'url' => route('team.dashboard')],
        ['title' => 'Tests'],
        ['title' => 'Component Test']
    ]"
    :showNotifications="true"
    :showChat="true"
    :showApps="true"
    :showUserMenu="true">
    
    <x-slot name="content">
        <!-- Container -->
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Component-Based Header Test
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                        Testing the new modular header components
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Container -->
        
        <!-- Container -->
        <div class="kt-container-fixed">
            <div class="grid gap-5 lg:gap-7.5">
                <div class="kt-card">
                    <div class="kt-card-header">
                        <h3 class="kt-card-title">Header Components Overview</h3>
                    </div>
                    <div class="kt-card-body">
                        <div class="grid gap-4">
                            <div class="flex items-center gap-3 p-4 bg-accent/20 rounded-lg">
                                <i class="ki-filled ki-check-circle text-green-500 text-xl"></i>
                                <div>
                                    <h4 class="font-semibold">✅ Breadcrumbs Component</h4>
                                    <p class="text-sm text-muted-foreground">Dynamic breadcrumb navigation</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-4 bg-accent/20 rounded-lg">
                                <i class="ki-filled ki-check-circle text-green-500 text-xl"></i>
                                <div>
                                    <h4 class="font-semibold">✅ User Menu Component</h4>
                                    <p class="text-sm text-muted-foreground">Profile, settings, and logout functionality</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-4 bg-accent/20 rounded-lg">
                                <i class="ki-filled ki-check-circle text-green-500 text-xl"></i>
                                <div>
                                    <h4 class="font-semibold">✅ Notifications Component</h4>
                                    <p class="text-sm text-muted-foreground">Notification drawer with badge</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-4 bg-accent/20 rounded-lg">
                                <i class="ki-filled ki-check-circle text-green-500 text-xl"></i>
                                <div>
                                    <h4 class="font-semibold">✅ Chat Component</h4>
                                    <p class="text-sm text-muted-foreground">Chat drawer functionality</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-4 bg-accent/20 rounded-lg">
                                <i class="ki-filled ki-check-circle text-green-500 text-xl"></i>
                                <div>
                                    <h4 class="font-semibold">✅ Apps Menu Component</h4>
                                    <p class="text-sm text-muted-foreground">Application grid with toggles</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-4 bg-green-100 dark:bg-green-900/20 rounded-lg">
                                <i class="ki-filled ki-shield-tick text-green-600 text-xl"></i>
                                <div>
                                    <h4 class="font-semibold text-green-800 dark:text-green-200">🔐 Logout Functionality</h4>
                                    <p class="text-sm text-green-600 dark:text-green-300">Secure logout with CSRF protection</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <h4 class="font-semibold text-blue-800 dark:text-blue-200 mb-2">How to Test:</h4>
                            <ul class="text-sm text-blue-600 dark:text-blue-300 space-y-1">
                                <li>• Check the breadcrumb navigation above</li>
                                <li>• Click the notification bell icon to open the drawer</li>
                                <li>• Click the chat icon to open the chat drawer</li>
                                <li>• Click the apps grid icon to see available apps</li>
                                <li>• Click your avatar to access profile and logout</li>
                                <li>• Test the logout functionality (will redirect to login)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Container -->
    </x-slot>
</x-team.layout.app>
