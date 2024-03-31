<?php

namespace MovieMatch\Models;

use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
  private Session $session;

  protected function setUp(): void
  {
    $this->session = new Session();
  }

  public function testStartIniciaUmaNovaSessaoSeNaoExistir()
  {
    $this->session->start();
    self::assertTrue(isset($_SESSION));
  }

  public function testStartNaoIniciaUmaNovaSessaoSeJaExistir()
  {
    $_SESSION['test_key'] = 'test_value';
    $this->session->start();
    self::assertEquals('test_value', $_SESSION['test_key']);
  }

  public function testGetRetornaValorCorretoSeChaveExistir()
  {
    $_SESSION['test_key'] = 'test_value';
    $value = $this->session->get('test_key');
    self::assertEquals('test_value', $value);
  }

  public function testGetRetornaNullSeChaveNaoExistir()
  {
    $value = $this->session->get('non_existing_key');
    self::assertNull($value);
  }

  public function testSetDefineValorCorretoParaChave()
  {
    $this->session->set('test_key', 'test_value');
    self::assertEquals('test_value', $_SESSION['test_key']);
  }

  public function testDestroyDestroiASessaoSeExistir()
  {
    $_SESSION['test_key'] = 'test_value';
    $this->session->destroy();
    self::assertFalse(isset($_SESSION));
  }


  public function testDestroyNaoFazNadaSeSessaoNaoExistir()
  {
    $this->session->destroy();
    self::assertTrue(true); // Não faz nada se a sessão não existir
  }
}
