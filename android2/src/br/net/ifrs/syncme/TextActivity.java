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
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

public class TextActivity extends Activity {

	private int userId;
	private ProgressDialog pDialog;

	JSONParser jsonParser = new JSONParser();
	private static String url_create_product = "http://10.0.2.2/syncme/syncme/ProfileListener.php";

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_text);

	}

	public void logout(View v) {
		LogoutTask ltask = new LogoutTask();
		ltask.setContext(getApplicationContext());
		ltask.execute();
		finish();
	}

	public void getText(View v) {
		GetTextTask gtTask = new GetTextTask();
		gtTask.setContext(getApplicationContext());
		gtTask.execute();
	}

	public void updateText(View v) {
		Toast.makeText(getApplicationContext(), "Send Text", Toast.LENGTH_SHORT)
				.show();
	}

	class CheckLoginTask extends AsyncTask<String, String, String> {
		String result = "...";
		private Context context;
		private boolean sucesso = false;

		public CheckLoginTask(Context context) {
			this.context = context;
		}

		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			pDialog = new ProgressDialog(context);
			pDialog.setMessage("Loading...");
			pDialog.setIndeterminate(false);
			pDialog.setCancelable(true);
			pDialog.show();
		}

		protected String doInBackground(String... args) {

			List<NameValuePair> params = new ArrayList<NameValuePair>();

			params.add(new BasicNameValuePair("opt", "CHECK_LOGIN"));

			JSONObject json = jsonParser.makeHttpRequest(url_create_product,
					"POST", params);

			try {
				if (json.has("error")) {
					result = json.getString("msgError");
				} else {
					userId = json.getInt("id");
					sucesso = true;
				}
			} catch (Exception e) {
				e.printStackTrace();
			}

			return null;
		}

		protected void onPostExecute(String file_url) {

			pDialog.dismiss();

			if (sucesso) {
				Toast.makeText(context, "" + userId, Toast.LENGTH_SHORT).show();
			} else {
				Toast.makeText(context, result, Toast.LENGTH_SHORT).show();
			}
		}

	}

	class LogoutTask extends AsyncTask<String, String, String> {
		String result = "...";
		private Context context;

		public void setContext(Context context) {
			this.context = context;
		}

		public LogoutTask() {
		}

		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			pDialog = new ProgressDialog(TextActivity.this);
			pDialog.setMessage("Loading...");
			pDialog.setIndeterminate(false);
			pDialog.setCancelable(true);
			pDialog.show();
		}

		protected String doInBackground(String... args) {

			List<NameValuePair> params = new ArrayList<NameValuePair>();

			params.add(new BasicNameValuePair("opt", "LOGOUT"));

			JSONObject json = jsonParser.makeHttpRequest(url_create_product,
					"POST", params);

			try {

				result = json.getString("msg");

			} catch (Exception e) {
				e.printStackTrace();
			}

			return null;
		}

		protected void onPostExecute(String file_url) {

			pDialog.dismiss();

			Toast.makeText(context, result, Toast.LENGTH_SHORT).show();

		}

	}
	
	class GetTextTask extends AsyncTask<String, String, String> {
		String result = "...";
		private Context context;

		public void setContext(Context context) {
			this.context = context;
		}

		public GetTextTask() {
		}

		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			pDialog = new ProgressDialog(TextActivity.this);
			pDialog.setMessage("Loading...");
			pDialog.setIndeterminate(false);
			pDialog.setCancelable(true);
			pDialog.show();
		}

		protected String doInBackground(String... args) {

			List<NameValuePair> params = new ArrayList<NameValuePair>();

			params.add(new BasicNameValuePair("opt", "GET_TEXT"));

			JSONObject json = jsonParser.makeHttpRequest(url_create_product,
					"POST", params);

			try {

				result = json.toString();

			} catch (Exception e) {
				e.printStackTrace();
			}

			return null;
		}

		protected void onPostExecute(String file_url) {

			pDialog.dismiss();

			Toast.makeText(context, result, Toast.LENGTH_SHORT).show();

		}

	}

}
