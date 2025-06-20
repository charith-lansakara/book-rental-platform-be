<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use App\Services\BookService;
use App\Repositories\BookRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class BookServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $bookService;
    protected $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repositoryMock = Mockery::mock(BookRepository::class);
        $this->bookService = new BookService($this->repositoryMock);
    }

    /** @test */
    public function it_creates_a_book_record()
    {
        $data = [
            'title' => 'Test Book',
            'author' => 'Test Author',
            'is_available' => true
        ];

        $this->repositoryMock
            ->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturn(new Book($data));

        $book = $this->bookService->create($data);

        $this->assertInstanceOf(Book::class, $book);
        $this->assertEquals('Test Book', $book->title);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
