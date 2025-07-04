{{-- Student Layout Component --}}
@props(['title' => 'Student Portal', 'showProgress' => true])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - AbstudERP Student</title>
    
    {{-- Student-specific styles --}}
    @vite(['resources/css/app.css', 'resources/css/student/layout.css'])
</head>
<body class="student-layout bg-green-50">
    <div class="min-h-screen">
        {{-- Student Header --}}
        <x-student.layout.header :title="$title" />
        
        <div class="flex">
            {{-- Student Sidebar --}}
            <x-student.navigation.sidebar />
            
            <div class="flex-1">
                @if($showProgress)
                    {{-- Progress Bar --}}
                    <x-student.layout.progress-bar />
                @endif
                
                {{-- Main Content --}}
                <main class="p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    
    {{-- Student-specific scripts --}}
    @vite(['resources/js/app.js', 'resources/js/student/layout.js'])
</body>
</html>
