# WP Content Framework (Test module)

[![License: GPL v2+](https://img.shields.io/badge/License-GPL%20v2%2B-blue.svg)](http://www.gnu.org/licenses/gpl-2.0.html)
[![PHP: >=5.6](https://img.shields.io/badge/PHP-%3E%3D5.6-orange.svg)](http://php.net/)
[![WordPress: >=3.9.3](https://img.shields.io/badge/WordPress-%3E%3D3.9.3-brightgreen.svg)](https://wordpress.org/)

[WP Content Framework](https://github.com/wp-content-framework/core) のモジュールです。

# 要件
- PHP 5.6 以上
- WordPress 3.9.3 以上

# インストール

``` composer require wp-content-framework/test ```  

## 依存モジュール
* [admin](https://github.com/wp-content-framework/admin)  

## テストの追加

- PHPUnitの追加  
```composer require --dev phpunit/phpunit```

- src/classes/tests に PHP ファイル (例：sample.php) を追加
```
<?php

namespace Example_Plugin\Classes\Tests;

if ( ! defined( 'EXAMPLE_PLUGIN' ) ) {
	exit;
}

/**
 * Class Sample
 * @package Example_Plugin\Classes\Tests
 */
class Sample extends \WP_Framework\Classes\Tests\Base {

	public function test_sample1() {
		$this->assertEquals( 2, 1 + 1 );
	}

	public function test_sample2() {
		$this->assertEquals( 1, 1 + 1 );
	}

}
```

- 管理画面から実行

![test1](https://raw.githubusercontent.com/wp-content-framework/core/images/test1.png)
![test2](https://raw.githubusercontent.com/wp-content-framework/core/images/test2.png)

# Author

[technote-space](https://github.com/technote-space)
