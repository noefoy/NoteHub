from flask import Flask, request, redirect, url_for
import threading
import subprocess

app = Flask(__name__)

# Global variable to control script execution
stop_script = False


# Function to run the main script
def run_main_script():
    global stop_script
    stop_script = False
    subprocess.run(["python", "main.py"])

# Function to stop the script
def stop_main_script():
    global stop_script
    stop_script = True

# Route to start the script
@app.route('/run-script', methods=['POST'])
def start_script():
    global stop_script
    if not stop_script:
        # Start the script in a separate thread
        threading.Thread(target=run_main_script).start()
        return redirect("http://localhost/NoteHub3/create_note.php")
    else:
        return redirect(url_for('index', error='Main script is already running!'))

# Route to stop the script
@app.route('/stop-script', methods=['POST'])
def stop_script_route():
    global stop_script
    print("Stop script route called")
    stop_main_script()
    return redirect("http://localhost/NoteHub3/create_note.php")

@app.route('/')
def index():
    success_message = request.args.get('success')
    error_message = request.args.get('error')
    return """
    <html>
    <body>
        <h1>Run main.py</h1>
        <form action="/run-script" method="post">
            <button type="submit">Run Script</button>
        </form>
        <form action="/stop-script" method="post">
            <button type="submit">Stop Script</button>
        </form>
        <p>{success}</p>
        <p>{error}</p>
    </body>
    </html>
    """.format(success=success_message, error=error_message)

if __name__ == '__main__':
    app.run(debug=True)
