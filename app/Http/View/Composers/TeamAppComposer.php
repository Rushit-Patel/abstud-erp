<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeamAppComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with([
            'appData' => $this->getAppData(),
        ]);
    }

    /**
     * Get all header-specific data
     */
    private function getAppData(): array
    {
        return [
            'companyLogo' => $this->getCompanyLogo(),
            'companyFavicon' => $this->getCompanyFavicon(),
            'companyName' => $this->getCompanyName(),
            'user' => $this->getUserData(),
            'notifications' => $this->getNotificationData(),
        ];
    }

    /**
     * Get company logo URL with fallback
     */
    private function getCompanyLogo(): string
    {
        $settings = CompanySetting::getSettings();
        
        if ($settings && $settings->company_logo && Storage::disk('public')->exists($settings->company_logo)) {
            return Storage::disk('public')->url($settings->company_logo);
        }

        return $this->getDefaultLogo();
    }

    private function getCompanyFavicon(): string
    {
        $settings = CompanySetting::getSettings();

        if ($settings && $settings->company_favicon && Storage::disk('public')->exists($settings->company_favicon)) {
            return Storage::disk('public')->url($settings->company_favicon);
        }

        return $this->getDefaultFavicon();
    }

    /**
     * Get company name with fallback
     */
    private function getCompanyName(): string
    {
        $settings = CompanySetting::getSettings();
        
        return $settings?->company_name ?? config('app.name', 'AbstudERP');
    }

    /**
     * Get authenticated user data
     */
    private function getUserData(): array
    {
        $user = Auth::user();
        
        if (!$user) {
            return [
                'name' => 'Guest',
                'email' => '',
                'initials' => 'G',
                'avatar' => null,
            ];
        }

        return [
            'name' => $user->name,
            'email' => $user->email,
            'initials' => $this->getUserInitials($user->name),
            'avatar' => $user->avatar ?? null,
        ];
    }

    /**
     * Get notification data for header
     */
    private function getNotificationData(): array
    {
        // This can be extended based on your notification system
        return [
            'count' => 0, // Replace with actual notification count
            'hasUnread' => false,
        ];
    }

    /**
     * Get user initials from name
     */
    private function getUserInitials(string $name): string
    {
        $words = explode(' ', $name);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
                if (strlen($initials) >= 2) break;
            }
        }
        
        return $initials ?: 'U';
    }

    /**
     * Get default logo path
     */
    private function getDefaultLogo(): string
    {
        return asset('images/default-logo.png');
    }
    private function getDefaultFavicon(): string
    {
        return asset('images/default-favicon.png');
    }
}
