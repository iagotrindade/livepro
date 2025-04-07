<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Room;
use App\Models\User;
use App\Models\Image;
use App\Models\Address;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Support;
use App\Models\Document;
use App\Models\Schedule;
use App\Models\Subscription;
use Illuminate\Support\Carbon;
use App\Models\SupportCategory;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use App\Models\DocumentValidation;
use App\Models\ProfessionalDocument;
use Illuminate\Support\Facades\Hash;
use App\Models\ProfessionalOccupation;
use Database\Seeders\PermissionSeeder;
use Database\Factories\SubscriptionFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(30)
            ->has(Address::factory()->count(20))
            ->create();
        Schedule::factory()
            ->count(100)
            ->create();
        Review::factory()
            ->count(50)
            ->create();
        ProfessionalOccupation::factory()
            ->count(30)
            ->create();
        Plan::factory()
            ->count(3)
            ->create();
        Subscription::factory()
            ->count(15)
            ->create();
        SupportCategory::factory()
            ->count(3)
            ->create();
        Support::factory()
            ->count(10)
            ->create();
        Document::factory()
            ->count(5)
            ->create();
        ProfessionalDocument::factory()
            ->count(25)
            ->create();
        DocumentValidation::factory()
            ->count(25)
            ->create();
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);
    }
}
