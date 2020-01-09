<?php

namespace CraftLogan\LaravelOverflow\Tests;

use CraftLogan\LaravelOverflow\Models\TestModel;
use CraftLogan\LaravelOverflow\Requests\OverflowFormRequest;
use Orchestra\Testbench\TestCase;

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

        $request = $this->createRequest('get', '', '/test', ['CONTENT_TYPE' => 'application/json'], $requestParams);

        $properties = json_decode($request->overflow());

        $this->assertObjectHasAttribute('testing',$properties);
    }


    /** @test */
    public function it_can_add_extra_properties_with_create_method()
    {
        $requestParams = [
            'name' => 'Big Leagues',
            'description' => 'This is when you make it to the big time',
            'testing' => true,
        ];
        $request = $this->createRequest('get', '', '/test', ['CONTENT_TYPE' => 'application/json'], $requestParams);
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
        $request = $this->createRequest('get', '', '/test', ['CONTENT_TYPE' => 'application/json'], $requestParams);
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

        $request = $this->createRequest('get', '', '/test', ['CONTENT_TYPE' => 'application/json'], $requestParams);

        $testmodel = new TestModel();
        $testmodel->name = $request->name;
        $testmodel->description = $request->description;
        $testmodel->properties = $request->overflow();
        $testmodel->save();

        $this->assertTrue($testmodel->properties()->testing);
    }


    protected function createRequest(
        $method,
        $content,
        $uri = '/test',
        $server = ['CONTENT_TYPE' => 'application/json'],
        $parameters = [],
        $cookies = [],
        $files = []
    ){
        $request = new OverflowFormRequest();
        return $request->createFromBase(
            \Symfony\Component\HttpFoundation\Request::create(
                $uri,
                $method,
                $parameters,
                $cookies,
                $files,
                $server,
                $content
            )
        );
    }






}
