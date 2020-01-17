<?php

namespace CraftLogan\LaravelOverflow\Tests;

use Orchestra\Testbench\TestCase;
use CraftLogan\LaravelOverflow\Models\TestModel;
use CraftLogan\LaravelOverflow\Requests\TestOverflowFormRequest;

class OverflowTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        require_once __DIR__ . '/../database/migrations/create_test_models_table.php';

        (new \CreateTestModelsTable())->up();
    }

    /** @test */
    public function it_can_add_multiple_extra_properties_to_overflow()
    {
        $requestParams = [
            'name' => 'Big Leagues',
            'description' => 'This is when you make it to the big time',
            'testing' => 'i am testing',
            'extra' => 'just some more extra stuff'
        ];
        $request = $this->createTestRequestWithParameters($requestParams);
        $properties = json_decode($request->overflow());

        $this->assertObjectHasAttribute('testing', $properties);
    }

    /** @test */
    public function it_can_add_extra_properties_with_create_method()
    {
        $requestParams = [
            'name' => 'Big Leagues',
            'description' => 'This is when you make it to the big time',
            'testing' => true,
        ];
        $request = $this->createTestRequestWithParameters($requestParams);
        $testmodel = TestModel::create($request->allWithOverflow());
        $this->assertTrue($testmodel->properties()->testing);
    }

    /** @test */
    public function it_can_get_table_columns()
    {
        $requestParams = [
            'name' => 'Big Leagues',
            'description' => 'This is when you make it to the big time',
            'testing' => true,
        ];
        $tableColumnsShouldBe = [
            'id', 'name', 'description', 'properties', 'created_at', 'updated_at'
        ];
        $request = $this->createTestRequestWithParameters($requestParams);
        $tableColumns = $request->getTableColumns();
        $this->assertEqualsCanonicalizing($tableColumnsShouldBe, $tableColumns);
    }

    /** @test */
    public function it_can_add_extra_properties_using_model_attributes()
    {
        $requestParams = [
            'name' => 'Big Leagues',
            'description' => 'This is when you make it to the big time',
            'testing' => true,
        ];
        $request = $this->createTestRequestWithParameters($requestParams);
        $testmodel = new TestModel();
        $testmodel->name = $request->name;
        $testmodel->description = $request->description;
        $testmodel->properties = $request->overflow();
        $testmodel->save();
        $this->assertTrue($testmodel->properties()->testing);
    }

    protected function createTestRequestWithParameters($parameters)
    {
        return TestOverflowFormRequest::createFromBase(
            \Symfony\Component\HttpFoundation\Request::create(
                'overflowTest/',
                'POST',
                $parameters
            )
        );
    }
}
