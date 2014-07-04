package net.ifrs.syncme;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

public class TextActivity extends Activity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_text);
	}
	
	public void logout(View v){
		finish();
	}
	
	public void getText(View v){
		Toast.makeText(getApplicationContext(), "Get Text",
				Toast.LENGTH_SHORT).show();
	}
	
	public void updateText(View v){
		Toast.makeText(getApplicationContext(), "Send Text",
				Toast.LENGTH_SHORT).show();
	}
	
	
}
