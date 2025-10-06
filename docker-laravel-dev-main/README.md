<div align="center">

# 🐋 Docker Laravel Dev

**Laravel開発環境を簡単セットアップ！**

![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Apache](https://img.shields.io/badge/Apache-D22128?style=for-the-badge&logo=apache&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)

</div>

---

## 📋 目次
- [概要](#-概要)
- [含まれるサービス](#-含まれるサービス)
- [必須環境](#-必須環境)
- [クイックスタート](#-クイックスタート)
- [詳細ガイド](#-詳細ガイド)
  - [PHP/Laravel](#phplaravel)
  - [MariaDB](#mariadb)
  - [phpMyAdmin](#phpmyadmin)
  - [MailHog](#mailhog)
- [設定ファイル](#️-設定ファイル)
- [よく使うコマンド](#-よく使うコマンド)
- [アクセスURL](#-アクセスurl)

---

## ✨ 概要

このリポジトリは**Laravel開発環境**をDockerで簡単に構築できるテンプレートです。

**特徴**
- **即座に開発開始**: `docker compose up -d` 一発でLaravel環境が立ち上がる
- **フル機能**: phpMyAdmin、MailHogが標準装備
- **自動セットアップ**: 初回起動時にLaravelプロジェクトを自動作成
- **メールテスト**: 送信メールをブラウザで確認可能

---

## 📦 含まれるサービス

<table>
<thead>
<tr>
<th>サービス</th>
<th>説明</th>
<th>ポート</th>
<th>URL</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>PHP/Apache</strong></td>
<td>Laravel実行環境 + Composer</td>
<td>8080</td>
<td><a href="http://localhost:8080">localhost:8080</a></td>
</tr>
<tr>
<td><strong>MariaDB</strong></td>
<td>リレーショナルデータベース</td>
<td>3306</td>
<td>-</td>
</tr>
<tr>
<td><strong>phpMyAdmin</strong></td>
<td>データベース管理ツール</td>
<td>8081</td>
<td><a href="http://localhost:8081">localhost:8081</a></td>
</tr>
<tr>
<td><strong>MailHog</strong></td>
<td>メール送受信テストツール</td>
<td>8025</td>
<td><a href="http://localhost:8025">localhost:8025</a></td>
</tr>
</tbody>
</table>

---

## 🔧 必須環境

- **Docker** (Docker Desktop または Docker Engine)
- **Windows の場合**: Hyper-V または WSL2

> [!WARNING]
> WindowsではHyper-VとWSL2のどちらか一方がセットアップされている必要があります。

---

## 🚀 クイックスタート

### 1. リポジトリをクローン

```bash
git clone https://github.com/saitogo555/docker-laravel-dev.git
cd docker-laravel-dev
```

### 2. コンテナを起動

```bash
docker compose up -d
```

### 3. 完了！

**Laravel アプリケーション**: http://localhost:8080  
**phpMyAdmin**: http://localhost:8081  
**MailHog**: http://localhost:8025

---

## 📖 詳細ガイド

### PHP/Laravel

#### Laravel自動セットアップ

初回起動時、`src` フォルダが空の場合、最新のLaravelプロジェクトが自動でセットアップされます。

#### Composer & Artisan コマンド

**方法1: コンテナ内で実行**
```bash
docker compose exec php bash
php artisan migrate
composer install
```

**方法2: ホストから直接実行**
```bash
docker compose exec php php artisan migrate
docker compose exec php composer install
```

#### .envファイル自動生成

コンテナ起動時に以下の優先順位で `.env` ファイルを自動生成：

1. `.env.local` (最優先)
2. `.env.example`

#### メール設定

メール設定はMailHog用に自動で設定されます：

```env
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_FROM_ADDRESS="admin@example.com"
```

---

### MariaDB

#### データベース設定

`.env` ファイルに以下を設定：

```env
DB_CONNECTION=mysql
DB_HOST=mariadb
DB_PORT=3306
DB_DATABASE=laravel_app
DB_USERNAME=root
DB_PASSWORD=root
```

#### 直接アクセス

```bash
# MariaDBコンテナに入る
docker compose exec mariadb bash

# データベースにログイン
mariadb -u root -p laravel_app
# パスワード: root
```

---

### phpMyAdmin

**アクセス**: http://localhost:8081

**ログイン情報**
- **ユーザー**: `root`
- **パスワード**: `root`

---

### MailHog

**アクセス**: http://localhost:8025

PHPから送信されたメールは全てMailHogで受信され、ブラウザで確認できます。

---

## ⚙️ 設定ファイル

```
docker-laravel-dev/
├── php/
│   ├── dockerfile
│   ├── entrypoint.sh
│   ├── php.ini
│   └── 000-default.conf
├── src/              # Laravelプロジェクト
├── compose.yml       # Docker Compose設定
└── README.md
```

---

## 🔄 よく使うコマンド

<table>
<thead>
<tr>
<th>操作</th>
<th>コマンド</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>コンテナ起動</strong></td>
<td><code>docker compose up -d</code></td>
</tr>
<tr>
<td><strong>コンテナ停止</strong></td>
<td><code>docker compose down</code></td>
</tr>
<tr>
<td><strong>コンテナ再起動</strong></td>
<td><code>docker compose restart</code></td>
</tr>
<tr>
<td><strong>ログ確認</strong></td>
<td><code>docker compose logs -f</code></td>
</tr>
<tr>
<td><strong>PHPコンテナに入る</strong></td>
<td><code>docker compose exec php bash</code></td>
</tr>
<tr>
<td><strong>MariaDBコンテナに入る</strong></td>
<td><code>docker compose exec mariadb bash</code></td>
</tr>
<tr>
<td><strong>完全クリーンアップ</strong></td>
<td><code>docker compose down -v --rmi all</code></td>
</tr>
</tbody>
</table>

---

## 🔗 アクセスURL

| サービス | URL | 説明 |
|------------|--------|--------|
| **Laravel** | http://localhost:8080 | メインアプリケーション |
| **phpMyAdmin** | http://localhost:8081 | データベース管理 |
| **MailHog** | http://localhost:8025 | メール確認 |

---
