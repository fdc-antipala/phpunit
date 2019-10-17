<?php

use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase {
	protected function setUp(): void {
		$this->article = new App\Article;
	}


	public function titleProvider () {
		return array(
			"test1" => array("Gg wp", "Gg_wp"),
			"test2" => array("Gg  wp", "Gg_wp"),
			"test3" => array("Gg  \n  wp", "Gg_wp")
		);
	}

	/**
	* @dataProvider titleProvider
	*/
	public function testSlug ($title, $slug) {
		$this->article->title = $title;

		$this->assertEquals($this->article->getSlug(), $slug);
	}


}