<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Profile::query()->updateOrCreate([], [
            'name' => 'Ahmed Abu Mummer',
            'title' => 'Full-Stack Software Engineer',
            'bio' => "I'm a full-stack software engineer specialized in building business management systems — ERP, HR, financial, and inventory platforms that help organizations run their daily operations from a single dashboard.\n\nI work mainly with Laravel, Livewire and Filament to ship clean, secure, and maintainable web applications, from database design to a polished admin experience.",
            'avatar' => 'profile/01KXZH5AQKMJWGK6Z5G0JH5VH1.png',
            'email' => 'ahmedmummer86@gmail.com',
            'phone' => '+970 599 959 381',
            'location' => 'Palestine',
            'years_experience' => 3,
            'socials' => [],
            'highlights' => [
                ['value' => '3+', 'label' => 'Years of Experience'],
                ['value' => '6+', 'label' => 'Systems Built'],
                ['value' => '10+', 'label' => 'Modules Delivered'],
                ['value' => '100%', 'label' => 'Dedication'],
            ],
        ]);

        $skills = [
            // Backend
            ['name' => 'PHP', 'category' => 'Backend', 'level' => 92, 'sort_order' => 1],
            ['name' => 'Laravel', 'category' => 'Backend', 'level' => 95, 'sort_order' => 2],
            ['name' => 'RESTful API Development', 'category' => 'Backend', 'level' => 88, 'sort_order' => 3],
            ['name' => 'MVC Architecture', 'category' => 'Backend', 'level' => 88, 'sort_order' => 4],
            ['name' => 'Object-Oriented Programming (OOP)', 'category' => 'Backend', 'level' => 90, 'sort_order' => 5],
            ['name' => 'Authentication & Authorization', 'category' => 'Backend', 'level' => 85, 'sort_order' => 6],

            // Frontend
            ['name' => 'Livewire', 'category' => 'Frontend', 'level' => 92, 'sort_order' => 1],
            ['name' => 'Alpine.js', 'category' => 'Frontend', 'level' => 80, 'sort_order' => 2],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'level' => 88, 'sort_order' => 3],
            ['name' => 'JavaScript', 'category' => 'Frontend', 'level' => 78, 'sort_order' => 4],
            ['name' => 'Bootstrap', 'category' => 'Frontend', 'level' => 78, 'sort_order' => 5],
            ['name' => 'HTML5', 'category' => 'Frontend', 'level' => 90, 'sort_order' => 6],
            ['name' => 'CSS3', 'category' => 'Frontend', 'level' => 88, 'sort_order' => 7],

            // Database
            ['name' => 'MySQL', 'category' => 'Database', 'level' => 90, 'sort_order' => 1],
            ['name' => 'Database Design', 'category' => 'Database', 'level' => 85, 'sort_order' => 2],
            ['name' => 'Data Modeling', 'category' => 'Database', 'level' => 82, 'sort_order' => 3],
            ['name' => 'Query Optimization', 'category' => 'Database', 'level' => 78, 'sort_order' => 4],

            // Tools & Technologies
            ['name' => 'Git & GitHub', 'category' => 'Tools & Technologies', 'level' => 88, 'sort_order' => 1],
            ['name' => 'Composer', 'category' => 'Tools & Technologies', 'level' => 85, 'sort_order' => 2],
            ['name' => 'Vite', 'category' => 'Tools & Technologies', 'level' => 80, 'sort_order' => 3],
            ['name' => 'NPM', 'category' => 'Tools & Technologies', 'level' => 78, 'sort_order' => 4],
            ['name' => 'Postman', 'category' => 'Tools & Technologies', 'level' => 82, 'sort_order' => 5],
            ['name' => 'VS Code', 'category' => 'Tools & Technologies', 'level' => 90, 'sort_order' => 6],
            ['name' => 'Laragon', 'category' => 'Tools & Technologies', 'level' => 85, 'sort_order' => 7],

            // Professional Skills
            ['name' => 'Software Architecture', 'category' => 'Professional Skills', 'level' => 85, 'sort_order' => 1],
            ['name' => 'Clean Code', 'category' => 'Professional Skills', 'level' => 88, 'sort_order' => 2],
            ['name' => 'Problem Solving', 'category' => 'Professional Skills', 'level' => 90, 'sort_order' => 3],
            ['name' => 'Performance Optimization', 'category' => 'Professional Skills', 'level' => 80, 'sort_order' => 4],
            ['name' => 'Web Security', 'category' => 'Professional Skills', 'level' => 82, 'sort_order' => 5],
            ['name' => 'UI/UX Design Principles', 'category' => 'Professional Skills', 'level' => 78, 'sort_order' => 6],
            ['name' => 'Project Planning', 'category' => 'Professional Skills', 'level' => 82, 'sort_order' => 7],
            ['name' => 'Team Collaboration', 'category' => 'Professional Skills', 'level' => 88, 'sort_order' => 8],
        ];

        foreach ($skills as $skill) {
            Skill::query()->updateOrCreate(['name' => $skill['name']], $skill);
        }

        $projects = [
            [
                'title' => 'Administrative & Financial Management System',
                'category' => 'Web Application',
                'description' => "A comprehensive web-based management platform that streamlines daily administrative and financial operations for organizations. Integrates employees, payroll, correspondence, financial transactions, reports, and inventory into a single smart dashboard with real-time analytics and notifications.\n\nKey features: Employee Management, Payroll Management, Financial Management, Administrative Correspondence, Inventory Management, Reports & Statistics, User Roles & Permissions, Import/Export (Excel/PDF), Backup & Restore, Notifications & Reminders.\n\nTechnologies: Laravel, PHP, Filament, Livewire, MySQL, Tailwind CSS, JavaScript, HTML5, CSS3.",
                'image' => 'projects/admin-financial-system-budget.png',
                'featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Human Resources Management System',
                'category' => 'Web Application',
                'description' => "A complete HR solution for managing employees, departments, attendance, payroll, contracts, leave requests, and performance reports.\n\nTechnologies: Laravel, Livewire, Filament, MySQL.",
                'image' => 'projects/admin-financial-system-employees.png',
                'featured' => false,
                'sort_order' => 2,
            ],
            [
                'title' => 'Inventory Management System',
                'category' => 'Web Application',
                'description' => "A smart inventory application for tracking products, stock movements, suppliers, purchase orders, and warehouse reports.\n\nTechnologies: Laravel, MySQL, Tailwind CSS.",
                'image' => 'projects/inventory-management-system.svg',
                'featured' => false,
                'sort_order' => 3,
            ],
            [
                'title' => 'Document & Correspondence Management System',
                'category' => 'Web Application',
                'description' => "A digital platform for managing incoming and outgoing correspondence, file attachments, approvals, reminders, and document archiving.\n\nTechnologies: Laravel, Filament, Livewire.",
                'image' => 'projects/document-correspondence-management-system.svg',
                'featured' => false,
                'sort_order' => 4,
            ],
            [
                'title' => 'Financial Reporting Dashboard',
                'category' => 'Web Application',
                'description' => "A real-time dashboard providing financial statistics, interactive charts, KPI monitoring, and detailed reporting for decision-makers.\n\nTechnologies: Laravel, Chart.js, MySQL.",
                'image' => 'projects/admin-financial-system-assistance.png',
                'featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'Employee Payroll System',
                'category' => 'Web Application',
                'description' => "An automated payroll management system capable of calculating salaries, deductions, allowances, and taxes, and generating monthly payroll reports.\n\nTechnologies: Laravel, PHP, MySQL.",
                'image' => 'projects/employee-payroll-system.svg',
                'featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($projects as $project) {
            Project::query()->updateOrCreate(['title' => $project['title']], $project);
        }
    }
}
