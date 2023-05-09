##　udemy Laravel講座

##ダウンロード方法

git clone

git clone https://github.com/nscfmk/laravel_umarche.git

git clone ブランチを指定してダウンロードする場合

git clone -b ブランチ名　https://github.com/nscfmk/laravel_umarche.git

もしくはzipファイルでダウンロードしてくだい


##インストール方法

cd laravel_umarche
composer install
npm install
npm run dev

.env.exampleをコピーして.envファイルを作成

.envファイルの中の下記をご利用の環境に合わせて変更してください。

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=8889
DB_DATABASE=laravel_umarche
DB_USERNAME=umarche

XAMPP/MAMPまたは他の開発環境でDBを起動した後に

php artisan migrate:fresh --seed
と実行してください(データベースとダミーデータが追加されればOK)

最後に
php artisan key:generate
と入力してキーを生成後、

php artisan serve で簡易サーバーを立ち上げ表示を確認してください。

##インストール後の実施事項

画像のダミーデーはpublic/imagesフォルダ内に
sample1.jpg ~ sample6.jpgとして保存しています。

php artisan storage:linkでstorageフォルダにリンク後、

storage/app/public/productsフォルダ内に保存すると表示される。
(productsフォルダがない場合は作成してください。)

ショップの画像も表示する場合は、
storage/app/public/shopsフォルダを作成し
画像を保存してください

##section7の補足
決済のテストとしてstripeを利用しています
必要な場合は.envにstripeの情報を追記してください。
（講座内で解説しています）

##section8の補足
メール処理には時間がかかるのでキューを使用しています。

必要な場合は php artisan queue:work
でワーカーを立ち上げて動作確認するようにしてください。

##