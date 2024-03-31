<?php

namespace MovieMatch\Models;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
  private User $user;

  protected function setUp(): void
  {
    $name = "John Doe";
    $grades = [5, 7, 9];
    $rateds = [1, 2, 3];

    $this->user = new User($name, $grades, $rateds);
  }

  public function testGetNameRetornaNomeCorreto()
  {
    self::assertEquals("John Doe", $this->user->getName());
  }

  public function testGetGradesRetornaArrayDeNotas()
  {
    self::assertCount(3, $this->user->getGrades());
    self::assertEquals([5, 7, 9], $this->user->getGrades());
  }

  public function testGetGradeRetornaNotaCorretaPorID()
  {
    self::assertEquals(7, $this->user->getGrade(1));
  }

  public function testGetRatedsRetornaArrayDeFilmesAvaliados()
  {
    self::assertCount(3, $this->user->getRateds());
    self::assertEquals([1, 2, 3], $this->user->getRateds());
  }
}
