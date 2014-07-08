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
import android.widget.EditText;
import android.widget.Toast;

public class TextActivity extends Activity {

	private int textId;
	private ProgressDialog pDialog;
	private String sessionId;
	private EditText text;

	JSONParser jsonParser = new JSONParser();
	private static String url_create_product = "http://10.0.2.2/syncme/syncme/ProfileListener.php";

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_text);
		Intent intent2 = getIntent();
		sessionId = intent2.getStringExtra("sessionId");
		text = (EditText) findViewById(R.id.mainText);
		getText(null);
		
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
		UpdateTextTask utTask = new UpdateTextTask();
		utTask.setContext(getApplicationContext());
		utTask.execute();
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
		private boolean sucesso = false;

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
			params.add(new BasicNameValuePair("sessionId", sessionId));

			JSONObject json = jsonParser.makeHttpRequest(url_create_product,
					"POST", params);

			try {
				if (json.has("error")) {
					result = json.getString("msgError");
					sucesso = false;
				} else {

					result = json.getString("text");
					textId = json.getInt("id");
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
				text.setText(result);
				// TODO persisir text
			} else {
				Toast.makeText(context, result, Toast.LENGTH_SHORT).show();
				finish();
			}
		}

	}

	class UpdateTextTask extends AsyncTask<String, String, String> {
		String result = "...";
		private Context context;
		private boolean sucesso = false;

		public void setContext(Context context) {
			this.context = context;
		}

		public UpdateTextTask() {
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

			params.add(new BasicNameValuePair("opt", "UPDATE_TEXT"));
			params.add(new BasicNameValuePair("sessionId", sessionId));
			params.add(new BasicNameValuePair("text", text.getText().toString()));
			params.add(new BasicNameValuePair("id", textId + ""));

			JSONObject json = jsonParser.makeHttpRequest(url_create_product,
					"POST", params);

			try {
				if (json.has("error")) {
					result = json.getString("msgError");
					sucesso = false;
				} else {

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
			if (!sucesso) {
				finish();
			}
		}

	}

}
