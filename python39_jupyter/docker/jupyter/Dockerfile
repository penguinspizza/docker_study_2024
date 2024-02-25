# Python3.9 slimイメージをベースに使用
FROM python:3.9-slim

# 作業ディレクトリを設定。これにより、コンテナ内での作業がこのディレクトリから行われる。
WORKDIR /usr/src/app

# Pythonの依存関係ファイルをコピー
COPY requirements.txt ./

# 依存関係のインストール。--no-cache-dirオプションでキャッシュを無効化し、イメージサイズを小さく保つ。
RUN pip install --no-cache-dir -r requirements.txt

# Jupyter Notebook用にポート8888を公開
EXPOSE 8888

# Jupyter Notebookを起動するコマンド
CMD ["jupyter", "notebook", "--ip=0.0.0.0", "--allow-root", "--NotebookApp.token=''", "--NotebookApp.password=''"]
