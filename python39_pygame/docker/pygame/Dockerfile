# Python3.9 slimイメージをベースに使用
FROM python:3.9-slim

# 作業ディレクトリを設定。これにより、コンテナ内での作業がこのディレクトリから行われる。
WORKDIR /root

# Pythonの依存関係ファイルをコピー
COPY requirements.txt ./

# set -x: デバッグ情報を出力する
# apt-get install -y x11-apps: X11アプリケーションをインストール
# pip install --no-cache-dir -r requirements.txt: 依存関係のインストール。--no-cache-dirオプションでキャッシュを無効化し、イメージサイズを小さく保つ。
RUN set -x && \
    apt-get update && \
    apt-get install -y x11-apps && \
    pip install --no-cache-dir -r requirements.txt
