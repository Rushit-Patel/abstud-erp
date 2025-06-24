<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Partner;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->createWebGuardRolesAndPermissions();
        $this->createStudentGuardRolesAndPermissions();
        $this->createPartnerGuardRolesAndPermissions();
    }

    /**
     * Create roles and permissions for web guard (Admin/Staff)
     */
    private function createWebGuardRolesAndPermissions(): void
    {
        // Web guard permissions
        $webPermissions = [
            // User Management
            'manage_users',
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            
            // Role & Permission Management
            'manage_roles',
            'view_roles',
            'assign_roles',
            'manage_permissions',
            
            // Company & Branch Management
            'manage_company_settings',
            'view_company_settings',
            'manage_branches',
            'view_branches',
            'create_branches',
            'edit_branches',
            'delete_branches',
            
            // Student Management
            'manage_students',
            'view_students',
            'create_students',
            'edit_students',
            'delete_students',
            'approve_students',
            'suspend_students',
            
            // Partner Management
            'manage_partners',
            'view_partners',
            'create_partners',
            'edit_partners',
            'delete_partners',
            'approve_partners',
            'suspend_partners',
            
            // System & Reports
            'view_dashboard',
            'view_reports',
            'generate_reports',
            'manage_system_settings',
            'backup_system',
            'restore_system',
            
            // Advanced Features
            'manage_announcements',
            'manage_notifications',
            'view_audit_logs',
            'manage_integrations',
        ];

        foreach ($webPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // Create web guard roles
        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        $manager = Role::firstOrCreate([
            'name' => 'Manager',
            'guard_name' => 'web'
        ]);

        $staff = Role::firstOrCreate([
            'name' => 'Staff',
            'guard_name' => 'web'
        ]);

        // Assign permissions to roles
        $superAdmin->syncPermissions(Permission::where('guard_name', 'web')->get());

        $admin->syncPermissions([
            'view_dashboard',
            'view_users',
            'manage_students',
            'view_students',
            'create_students',
            'edit_students',
            'approve_students',
            'suspend_students',
            'manage_partners',
            'view_partners',
            'create_partners',
            'edit_partners',
            'approve_partners',
            'suspend_partners',
            'view_reports',
            'generate_reports',
            'manage_announcements',
            'manage_notifications',
            'view_branches',
        ]);

        $manager->syncPermissions([
            'view_dashboard',
            'view_students',
            'edit_students',
            'view_partners',
            'edit_partners',
            'view_reports',
            'manage_announcements',
            'view_branches',
        ]);

        $staff->syncPermissions([
            'view_dashboard',
            'view_students',
            'view_partners',
            'view_reports',
        ]);
    }

    /**
     * Create roles and permissions for student guard
     */
    private function createStudentGuardRolesAndPermissions(): void
    {
        // Student guard permissions
        $studentPermissions = [
            // Profile Management
            'view_profile',
            'edit_profile',
            'update_password',
            'upload_profile_photo',
            
            // Academic
            'view_courses',
            'enroll_courses',
            'view_grades',
            'view_attendance',
            'view_schedule',
            'download_certificates',
            
            // Communication
            'view_announcements',
            'view_notifications',
            'send_messages',
            'view_messages',
            
            // Resources
            'view_resources',
            'download_resources',
            'view_library',
            
            // Support
            'submit_support_ticket',
            'view_support_tickets',
            'view_faq',
        ];

        foreach ($studentPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'student'
            ]);
        }

        // Create student roles
        $activeStudent = Role::firstOrCreate([
            'name' => 'Active Student',
            'guard_name' => 'student'
        ]);

        $graduatedStudent = Role::firstOrCreate([
            'name' => 'Graduated Student',
            'guard_name' => 'student'
        ]);

        $suspendedStudent = Role::firstOrCreate([
            'name' => 'Suspended Student',
            'guard_name' => 'student'
        ]);

        // Assign permissions to student roles
        $activeStudent->syncPermissions(Permission::where('guard_name', 'student')->get());

        $graduatedStudent->syncPermissions([
            'view_profile',
            'edit_profile',
            'update_password',
            'upload_profile_photo',
            'view_grades',
            'view_attendance',
            'download_certificates',
            'view_announcements',
            'view_notifications',
            'view_resources',
            'download_resources',
            'view_faq',
        ]);

        $suspendedStudent->syncPermissions([
            'view_profile',
            'view_announcements',
            'view_faq',
        ]);
    }

    /**
     * Create roles and permissions for partner guard
     */
    private function createPartnerGuardRolesAndPermissions(): void
    {
        // Partner guard permissions
        $partnerPermissions = [
            // Profile & Company Management
            'view_profile',
            'edit_profile',
            'update_password',
            'upload_profile_photo',
            'manage_company_info',
            
            // Student Management
            'view_partner_students',
            'nominate_students',
            'track_student_progress',
            'approve_student_applications',
            
            // Collaboration
            'view_programs',
            'create_programs',
            'edit_programs',
            'manage_internships',
            'create_job_postings',
            'manage_job_postings',
            
            // Communication
            'view_announcements',
            'view_notifications',
            'send_messages',
            'view_messages',
            'communicate_with_admin',
            
            // Reports & Analytics
            'view_partner_reports',
            'generate_partner_reports',
            'view_analytics',
            'export_data',
            
            // Resources
            'view_partner_resources',
            'upload_resources',
            'manage_documents',
            
            // Support
            'submit_support_ticket',
            'view_support_tickets',
            'view_faq',
        ];

        foreach ($partnerPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'partner'
            ]);
        }

        // Create partner roles
        $corporatePartner = Role::firstOrCreate([
            'name' => 'Corporate Partner',
            'guard_name' => 'partner'
        ]);

        $educationalPartner = Role::firstOrCreate([
            'name' => 'Educational Partner',
            'guard_name' => 'partner'
        ]);

        $recruitmentPartner = Role::firstOrCreate([
            'name' => 'Recruitment Partner',
            'guard_name' => 'partner'
        ]);

        $suspendedPartner = Role::firstOrCreate([
            'name' => 'Suspended Partner',
            'guard_name' => 'partner'
        ]);

        // Assign permissions to partner roles
        $corporatePartner->syncPermissions(Permission::where('guard_name', 'partner')->get());

        $educationalPartner->syncPermissions([
            'view_profile',
            'edit_profile',
            'update_password',
            'upload_profile_photo',
            'manage_company_info',
            'view_partner_students',
            'nominate_students',
            'track_student_progress',
            'view_programs',
            'create_programs',
            'edit_programs',
            'view_announcements',
            'view_notifications',
            'send_messages',
            'view_messages',
            'communicate_with_admin',
            'view_partner_reports',
            'view_partner_resources',
            'upload_resources',
            'manage_documents',
            'submit_support_ticket',
            'view_support_tickets',
            'view_faq',
        ]);

        $recruitmentPartner->syncPermissions([
            'view_profile',
            'edit_profile',
            'update_password',
            'upload_profile_photo',
            'manage_company_info',
            'view_partner_students',
            'create_job_postings',
            'manage_job_postings',
            'view_announcements',
            'view_notifications',
            'send_messages',
            'view_messages',
            'communicate_with_admin',
            'view_partner_reports',
            'generate_partner_reports',
            'view_analytics',
            'export_data',
            'view_partner_resources',
            'submit_support_ticket',
            'view_support_tickets',
            'view_faq',
        ]);

        $suspendedPartner->syncPermissions([
            'view_profile',
            'view_announcements',
            'view_faq',
        ]);
    }
}
