<?php

namespace CraftLogan\LaravelOverflow\Tests;

use CraftLogan\LaravelOverflow\LaravelOverflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Orchestra\Testbench\TestCase;
use CraftLogan\LaravelOverflow\Models\TestModel;
use CraftLogan\LaravelOverflow\Requests\TestOverflowFormRequest;

class OverflowTest extends TestCase
{
    public function setUp(): void
    {

        parent::setUp();

        $this->app = $this->createApplication();


        require_once __DIR__ . '/../database/migrations/create_test_models_table.php';

        (new \CreateTestModelsTable())->up();
    }

    protected function getPackageProviders($app)
    {
        return [
            'CraftLogan\LaravelOverflow\LaravelOverflowServiceProvider'
        ];
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
        $overflow = new LaravelOverflow($this->createTestIlluminateRequestWithParameters([]), new TestModel());
        $tableColumns = $overflow->getTableColumns();
        $this->assertEqualsCanonicalizing($tableColumnsShouldBe, $tableColumns);
    }

    /** @test */
    public function it_can_add_extra_properties_with_macro_request()
    {
        $requestParams = [
            'name' => 'Big Leagues',
            'description' => 'This is when you make it to the big time',
            'testing' => true,
        ];
        $request = $this->createTestIlluminateRequestWithParameters($requestParams);
        $testmodel = new TestModel();
        $testmodel->name = $request->name;
        $testmodel->description = $request->description;
        $testmodel->properties = $request->overflow($testmodel);
        $testmodel->save();
        $this->assertTrue($testmodel->properties()->testing);
    }

    /** @test */
    public function it_can_add_extra_properties_with_macro_create_method()
    {
        $requestParams = [
            'name' => 'Big Leagues',
            'description' => 'This is when you make it to the big time',
            'testing' => true,
        ];
        $request = $this->createTestIlluminateRequestWithParameters($requestParams);
        $testmodel = TestModel::create($request->allWithOverflow(new TestModel));
        $this->assertTrue($testmodel->properties()->testing);
    }


    protected function createTestIlluminateRequestWithParameters($parameters)
    {
        return Request::createFromBase(
            \Symfony\Component\HttpFoundation\Request::create(
                'overflowTest/',
                'POST',
                $parameters
            )
        );
    }
}
