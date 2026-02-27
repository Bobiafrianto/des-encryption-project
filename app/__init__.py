import os
from flask import Flask
from config import Config

def create_app():
    app = Flask(__name__)
    app.config.from_object(Config)
    # Ensure UPLOAD_FOLDER is absolute and exists
    app.config['UPLOAD_FOLDER'] = os.path.join(app.root_path, 'static', 'uploads')
    os.makedirs(app.config['UPLOAD_FOLDER'], exist_ok=True)

    from .routes import main
    app.register_blueprint(main)

    return app

import os
from flask import Flask
from config import Config

def create_app():
    app = Flask(__name__)
    app.config.from_object(Config)

    upload_folder = os.path.join(app.root_path, 'static', 'uploads')
    app.config['UPLOAD_FOLDER'] = upload_folder

    # Pastikan folder uploads ada
    os.makedirs(upload_folder, exist_ok=True)

    # expired dalam detik → 10 menit = 600
    app.config.setdefault('FILE_EXPIRE_TIME', 600)

    from .routes import main
    app.register_blueprint(main)

    return app
