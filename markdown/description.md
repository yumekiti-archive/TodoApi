laravel+Vue api作成
===
###### tags: `自習`

## 概要
LTS縛りで作る
- laravel 6
- php 7.4-fpm
- vue v3
- node 14.17.0
- mysql 5.7
- nginx 1.20.0

# Laravel

## インストール
- laravelを以下コマンドを使用しインストールする。
`composer create-project --prefer-dist laravel/laravel blog "6.*"`

- 開発サーバーを開く
`php artisan serve`
> テスト環境なので本番環境では使わないこと。

[詳しく](https://readouble.com/laravel/6.x/ja/installation.html)

## 設定
- `.env`を変更し設定を変える
> gitには上げれないので`.env.example`に設定を書き`.env`としてコピーする。

[詳しく](https://readouble.com/laravel/6.x/ja/configuration.html)

## マイグレーション

### データ構造考える
- 考えたものを**ER図**で分かりやすくする。
> markdownに画像置くの面倒だし、今回は簡単なので省略する

| 論理名 | 物理名  | 型  | 型の意味 |
| -------- | -------- | -------- | -------- |
| ID | id | bigIncrements | 連番(主キー) |
| タイトル | title | string,30 | 30字までの文字列 |
| 作成日 | created_at | timestamps | 日付、時刻 |
| 更新日 | updated_at | timestamps | 日付、時刻 |

| 論理名 | 物理名  | 型  | 型の意味 |
| -------- | -------- | -------- | -------- |
| グループID | group_id | bigIncrements | 連番(主キー) |
| グループ名 | group_name | string,30 | 30字までの文字列 |
| 作成日 | created_at | timestamps | 日付、時刻 |
| 更新日 | updated_at | timestamps | 日付、時刻 |


### モデルとマイグレーションファイルを作成する
- 以下コマンドで作成できる。
`php artisan make:model 名前 --migration`
> 名前の最初は大文字

- 今回は以下2つを実行
`php artisan make:model Todo --migration`
`php artisan make:model Group --migration`

### モデルとマイグレーションファイルを編集する
- database->migrations->2021_05_22_022115_create_todos_table.php
```php=
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
```
- database->migrations->2021_05_22_022129_create_groups_table.php
```php=
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('group_id');
            $table->string('group_name', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
```

### マイグレーション実行
以下コマンドでマイグレーション実行し、データを追加しましょう
`php artisan migrate`

[詳しく](https://readouble.com/laravel/6.x/ja/migrations.html)

### シーダーについて(テストデータの挿入)
以下コマンドでファイルを作成する。
`php artisan make:seeder TodoTableSeeder`
`php artisan make:seeder GroupTableSeeder`

- database->seeds->TodoTableSeeder.php
```php=
<?php

use Illuminate\Database\Seeder;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $titles = ['テスト１', 'テスト２', 'テスト３'];

        foreach ($titles as $title) {
            DB::table('todos')->insert([
                'title' => $title,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }

    }
}
```

- database->seeds->GroupTableSeeder.php
```php=
<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $groups = ['グループ１', 'グループ２', 'グループ３'];

        foreach ($groups as $group) {
            DB::table('groups')->insert([
                'group_name' => $group,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }
    }
}
```

- database->seeds->DatabaseSeeder.php
```php=
<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(TodoTableSeeder::class);
        $this->call(GroupTableSeeder::class);
    }
}
```

## モデル

- app->Group.php
```php=
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Todo;

class Group extends Model
{
    //
    public function Todo()
    {
        return $this->hasMany(Todo::class);
    }
}
```

[詳しく](https://readouble.com/laravel/6.x/ja/eloquent.html)

[リレーションについて](https://readouble.com/laravel/6.x/ja/eloquent-relationships.html)
> リレーションについては1対多などが書かれています

## コントローラー

