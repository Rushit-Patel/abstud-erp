{{-- Team Login Page using Component-Based Structure --}}
<x-team.auth.layout title="Team Login - AbstudERP">
    
    <x-team.forms.login-form :action="route('team.login.store')">
        {{-- Email Field --}}

        <x-team.forms.input label="User Name" name="email" type="text" placeholder="Enter your User Name" :required="true" />

        <x-team.forms.input label="Password" name="password" type="password" placeholder="Enter your password" :required="true" />
            
        <x-team.forms.checkbox name="remember" label="Remember me for 30 days" />

        <x-team.forms.button>
            Sign In to Admin Panel
        </x-team.forms.button>

    </x-team.forms.login-form>

    {{-- Footer with portal links --}}
    <x-slot name="footer">
        <x-team.auth.footer />
    </x-slot>

</x-team.auth.layout>
