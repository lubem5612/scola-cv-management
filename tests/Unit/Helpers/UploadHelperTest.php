<?php


namespace Transave\ScolaCvManagement\Tests\Unit\Helpers;


use Illuminate\Http\UploadedFile;
use Transave\ScolaCvManagement\Helpers\UploadHelper;
use Transave\ScolaCvManagement\Tests\TestCase;

class UploadHelperTest extends TestCase
{
    private $uploader, $file;
    public function setUp(): void
    {
        parent::setUp();
        $this->file = UploadedFile::fake()->create('file.pdf', 50, 'application/pdf');
        $this->uploader = new UploadHelper();
    }

    /** @test */
    public function can_upload_file_successfully()
    {
        $response = $this->uploader->uploadFile($this->file, 'credentials');
        $this->assertEquals(true, $response['success']);
        $this->assertNotNull($response['upload_url']);
    }

    /** @test */
    public function can_upload_or_replace_file_successfully()
    {
        $user = config('scolacv.auth_model')::factory()->create();
        $image = UploadedFile::fake()->image('photo.jpg');
        $response = $this->uploader->uploadOrReplaceFile($image, 'profiles', $user, 'picture');
        $this->assertEquals(true, $response['success']);
        $this->assertNotNull($response['upload_url']);
    }

    /** @test */
    public function can_delete_uploaded_file_successfully()
    {
        $upload = $this->uploader->uploadFile($this->file, 'credentials');
        $response = $this->uploader->deleteFile($upload['upload_url']);
        $this->assertEquals(true, $response['success']);
        $this->assertNotNull($response['upload_url']);
    }
}