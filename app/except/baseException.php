<?
class baseException //extends Exception
{
	/**
	 * Что бы не произошло вызываем страницу ErrorPage404
	 */
	private $num_page;

	public function __construct(Numpage $numpage)
	{
		//Exception::__construct('Вызываем страницу 404 '.$numpage->oneLine);
		$this->num_page = $num_page;
	}
  public function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
}
?>
