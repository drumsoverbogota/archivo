import audio_metadata
import datetime
import os
import sys


from PyQt5.QtWidgets import QApplication
from PyQt5.QtWidgets import QDialog
from PyQt5.QtWidgets import QTabWidget
from PyQt5.QtWidgets import QTextEdit
from PyQt5.QtWidgets import QGridLayout
from PyQt5.QtWidgets import QHBoxLayout
from PyQt5.QtWidgets import QVBoxLayout
from PyQt5.QtWidgets import QPushButton
from PyQt5.QtWidgets import QWidget
from PyQt5.QtWidgets import QMessageBox
from PyQt5.QtWidgets import QFileDialog
from PyQt5.QtWidgets import QCheckBox
from PyQt5.QtWidgets import QStyleFactory



class Application(QWidget):

    tabs = {}
    output_textedit = None

    def __init__(self, parent=None):

        super(Application, self).__init__(parent)

        self.setWindowTitle("Pun")
        self.tab_widget = QTabWidget()
        self.resize(600, 400)

        #self.changeStyle('Windows')
        tab1 = QWidget()

        self.tabs["&List Songs"] = tab1

        tab1.setLayout(self.create_list_tab())

        for tab in self.tabs:
            self.tab_widget.addTab(self.tabs[tab], tab)

        main_layout = QVBoxLayout()
        main_layout.addWidget(self.tab_widget)
        self.setLayout(main_layout)

        #Variables

        self.path = "H:\RIPS\Archivo Punk"
        self.time_offset = 0.25
        self.song_metadata = []
        self.supported_extensions = [".mp3", ".flac"]

    def create_list_tab(self):

        layout = QGridLayout()

        text_edit = QTextEdit()
        text_edit.setReadOnly(True)

        self.output_textedit = text_edit

        self.update_textedit("Open a folder to list the songs.")
        button = QPushButton('&Open Folder')
        button.clicked.connect(self.on_button_clicked)
        layout.addWidget(text_edit, 0, 0)
        layout.addWidget(button, 1, 0)

        checkbox_layout = QHBoxLayout()
        layout.addLayout(checkbox_layout, 2, 0)

        self.artist_checkbox = QCheckBox("&Artist")
        self.artist_checkbox.toggled.connect(self.update_list)
        checkbox_layout.addWidget(self.artist_checkbox)

        self.time_checkbox = QCheckBox("&Time")
        self.time_checkbox.toggled.connect(self.update_list)
        checkbox_layout.addWidget(self.time_checkbox)

        self.header_checkbox = QCheckBox("&Header")
        self.header_checkbox.toggled.connect(self.update_list)
        checkbox_layout.addWidget(self.header_checkbox)

        return layout

    def update_textedit(self, text):
        self.output_textedit.setPlainText(text)

    def create_list(self):
        
        if self.header_checkbox.isChecked():
            song_list = "Visiten El Muladar, un archivo de punk colombiano http://elmuladar.com\n\n"
        else:
            song_list = ""

        duration = datetime.datetime(10,1,1,0,0,0)
        for song in self.song_metadata:
            
            tracknumber = song.tags.tracknumber[0]
            artist = song.tags.artist[0]
            title = song.tags.title[0]
            seconds = song.streaminfo.duration

            total_minutes = duration.minute + (duration.hour * 60)
            total_seconds = duration.second

            if total_seconds <= 9:
                total_seconds = "0" + str(total_seconds)

            track = ""

            # Add track number
            track += f"{tracknumber}. "

            # Add Artist
            if self.artist_checkbox.isChecked():
                track += f"{artist} - "

            # Add title
            track += f"{title} "

            # Add time
            if self.time_checkbox.isChecked():
                track += f"{total_minutes}:{total_seconds}"

            #track = f"{tracknumber}. {artist} - {title} {total_minutes}:{total_seconds}\n"

            track = track.strip() + "\n"

            song_list += track

            duration += datetime.timedelta(seconds=int(seconds + self.time_offset))

        if not song_list:
            song_list = "No files were found."

        return song_list

    def load_songs(self):
        song_metadata = []
        try:
            for filename in os.listdir(self.path):
                _, extension = os.path.splitext(filename)
                if extension in self.supported_extensions:
                    try:
                        metadata = audio_metadata.load(f"{self.path}/{filename}")
                        song_metadata.append(metadata)
                    except audio_metadata.exceptions.UnsupportedFormat:
                        print(f"Filerror opening {filename}")
                    except PermissionError:
                        print("Denied access")
        except PermissionError:
            print("Denied access")
        except Exception as e:
            print("Unknown exception while opening the folder. ", str(e))

        self.song_metadata = song_metadata

    def update_list(self):
        self.update_textedit(self.create_list())

    def on_button_clicked(self):
        path = ""

        options = QFileDialog.Options()

        dialog = QFileDialog()
        dialog.setOptions(options)
        dialog.setFileMode(QFileDialog.DirectoryOnly)
        dialog.setDirectory(self.path)

        if dialog.exec_() == QDialog.Accepted:
            self.path = dialog.selectedFiles()[0]
            self.load_songs()
            self.update_list()


if __name__ == '__main__':
    app = QApplication([])
    app.setStyle("WindowsVista")
    main_app = Application()
    main_app.show()
    sys.exit(app.exec_())
