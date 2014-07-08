package br.net.ifrs.syncme;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

public class LoginActivity extends Activity {

	public EditText inputEmail, inputPassword;

	private ProgressDialog pDialog;

	JSONParser jsonParser = new JSONParser();
	

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_login);
		inputEmail = (EditText) findViewById(R.id.editEmail);
		inputPassword = (EditText) findViewById(R.id.editPassword);

	}

	public void login(View v) {
		LoginTask task = new LoginTask(inputEmail.getText().toString(),
				inputPassword.getText().toString());
		task.setContext(getApplicationContext());
		task.execute();

	}
	public void config(View v) {
		Intent intent = new Intent(getApplicationContext(),
				ConfigActivity.class);
		
		startActivity(intent);

	}

	class LoginTask extends AsyncTask<String, String, String> {
		String email, password, sesionId, result = "...";
		private Context context;
		private boolean sucesso;
		private String url_server;
		
		public LoginTask(String email, String password) {
			this.email = email;
			this.password = password;
		}

		public void setContext(Context applicationContext) {
			this.context = applicationContext;

		}

		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			pDialog = new ProgressDialog(LoginActivity.this);
			pDialog.setMessage("Loading...");
			pDialog.setIndeterminate(false);
			pDialog.setCancelable(true);
			pDialog.show();
		}

		protected String doInBackground(String... args) {

			List<NameValuePair> params = new ArrayList<NameValuePair>();
			params.add(new BasicNameValuePair("email", email));
			params.add(new BasicNameValuePair("password", password));
			params.add(new BasicNameValuePair("opt", "LOGIN"));

			SharedPreferences sharedPref = getSharedPreferences("SYNCME", 0);
			
			url_server = sharedPref.getString("url_server",getString(R.string.url_server));
			
			JSONObject json = jsonParser.makeHttpRequest(url_server,"POST", params);

			try {
				if (json.has("error")) {
					result = json.getString("msgError");
				} else {
					sesionId = json.getString("sessionId");
					result = json.getString("msg");
					sucesso = true;
				}
			} catch (Exception e) {
				e.printStackTrace();
			}

			return null;
		}

		protected void onPostExecute(String file_url) {

			pDialog.dismiss();
			Toast.makeText(context, result, Toast.LENGTH_SHORT).show();
			if (sucesso) {
				Intent intent = new Intent(getApplicationContext(),
						TextActivity.class);
				intent.putExtra("sessionId", sesionId);
				startActivity(intent);
			}
		}

	}

}
