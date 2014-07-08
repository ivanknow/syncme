package br.net.ifrs.syncme;

import android.app.Activity;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

public class ConfigActivity extends Activity {
	EditText editUrlServer;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_config);
		editUrlServer = (EditText) findViewById(R.id.editUrlServer);
		SharedPreferences sharedPref = getSharedPreferences("SYNCME", 0);
		
		String url_server = sharedPref.getString("url_server",getString(R.string.url_server));
		
			editUrlServer.setText(url_server);
	
	}

	public void save(View v){
		
		String urlString = editUrlServer.getText().toString();
		
		if(urlString.trim().equals("")){
			urlString = getString(R.string.url_server);
		}

		SharedPreferences sharedPref = getSharedPreferences("SYNCME", 0);

		SharedPreferences.Editor editor = sharedPref.edit();

		editor.putString("url_server",urlString);
		
		editor.commit();
		
		finish();
	}

}
