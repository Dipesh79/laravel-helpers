<?php

namespace Dipesh79\LaravelHelpers\Tests\Filterable;

use Dipesh79\LaravelHelpers\Exception\FilterableColumnsNotSpecifiedException;
use Dipesh79\LaravelHelpers\Tests\BaseTestCase;
use Dipesh79\LaravelHelpers\Tests\Models\User;

/**
 * Class FilterableTest
 *
 * This class contains tests for the Filterable trait.
 */
class FilterableTest extends BaseTestCase
{
    /**
     * Tests the custom filter scope to ensure it returns the correct number of matches.
     *
     * This test creates two users and applies the custom filter to check if the correct
     * number of users are returned based on the filter query.
     *
     * @return void
     */
    public function testFilterScopeMatch(): void
    {
        $users = [
            [
                'name' => 'Dipesh Khanal',
                'email' => 'dipeshkhanal@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Dipesh Karki',
                'email' => 'dipeshkarki@gmail.com',
                'password' => bcrypt('password'),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $filter1 = User::customFilter('Dipesh Khanal')->get();

        $this->assertCount(1, $filter1);

        $this->assertEquals('Dipesh Khanal', $filter1->first()->name);

        $filter2 = User::customFilter('Dipesh')->get();

        $this->assertCount(2, $filter2);
    }

    /**
     * Tests the custom filter scope with specified columns to ensure it returns the correct number of matches.
     *
     * This test creates two users and applies the custom filter with specified columns to check if the correct
     * number of users are returned based on the filter query.
     *
     * @return void
     */
    public function testFilterWithColumns(): void
    {
        $users = [
            [
                'name' => 'Dipesh Khanal',
                'email' => 'dipeshkhanal@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Dipesh Karki',
                'email' => 'dipeshkarki@gmail.com',
                'password' => bcrypt('password'),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $filter1 = User::customFilter('Dipesh Khanal', ['name'])->get();

        $this->assertCount(1, $filter1);

        $this->assertEquals('Dipesh Khanal', $filter1->first()->name);

        $filter2 = User::customFilter('Dipesh', ['name'])->get();

        $this->assertCount(2, $filter2);

        $this->assertEquals('Dipesh Khanal', $filter2->first()->name);

        $this->assertEquals('Dipesh Karki', $filter2->last()->name);
    }

    public function testWithEmptyColumns(): void
    {
        $user = new User();

        $user->setFilterableColumns([]);

        $this->expectException(FilterableColumnsNotSpecifiedException::class);

        $user->customFilter('Dipesh Khanal')->get();


    }

}
