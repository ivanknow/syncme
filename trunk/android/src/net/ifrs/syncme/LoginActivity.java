package net.ifrs.syncme;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

public class LoginActivity extends Activity {
	public EditText inputEmail, inputPassword;

	private static final String OPT_LOGIN = "LOGIN";
	// Progress Dialog
	private ProgressDialog pDialog;

	JSONParser jsonParser = new JSONParser();
	private static String url_create_product = "http://10.0.2.2/workspace/syncme/syncme/ProfileListener.php";

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_login);
		inputEmail = (EditText) findViewById(R.id.etLogin);
		inputPassword = (EditText) findViewById(R.id.etPassword);
	}

	public void login(View v) {
		LoginTask task = new LoginTask(inputEmail.getText().toString(),
				inputPassword.getText().toString());
		task.setContext(getApplicationContext());
		task.execute();

	}

	class LoginTask extends AsyncTask<String, String, String> {
		String email, password, result = "pongas";
		private Context context;

		public LoginTask(String email, String password) {
			this.email = email;
			this.password = password;
		}

		public void setContext(Context applicationContext) {
			this.context = applicationContext;

		}

		/**
		 * Before starting background thread Show Progress Dialog
		 * */
		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			pDialog = new ProgressDialog(LoginActivity.this);
			pDialog.setMessage("Loading...");
			pDialog.setIndeterminate(false);
			pDialog.setCancelable(true);
			pDialog.show();
		}

		/**
		 * Creating product
		 * */
		protected String doInBackground(String... args) {

			// Building Parameters
			List<NameValuePair> params = new ArrayList<NameValuePair>();
			params.add(new BasicNameValuePair("email", email));
			params.add(new BasicNameValuePair("num2", password));
			params.add(new BasicNameValuePair("opt", OPT_LOGIN));

			// getting JSON Object
			// Note that create product url accepts POST method
			JSONObject json = jsonParser.makeHttpRequest(url_create_product,
					"POST", params);

			// check for success tag
			try {

				result = json.toString();
			} catch (Exception e) {
				e.printStackTrace();
			}

			return null;
		}

		/**
		 * After completing background task Dismiss the progress dialog
		 * **/
		protected void onPostExecute(String file_url) {
			// dismiss the dialog once done
			pDialog.dismiss();
			/*
			 * Intent intent = new
			 * Intent(getApplicationContext(),TextActivity.class);
			 * 
			 * startActivity(intent);
			 */
			Toast.makeText(context, result, Toast.LENGTH_SHORT).show();
		}

	}

}
