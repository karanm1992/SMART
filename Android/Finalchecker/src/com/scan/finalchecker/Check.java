package com.scan.finalchecker;

import android.app.Activity;
import android.os.Bundle;

public class Check extends Activity {
	
	protected void onCreate(Bundle savedInstanceState)
	{
		super.onCreate(savedInstanceState);
		setContentView(R.layout.check);
		Bundle extras = getIntent().getExtras();
		if (extras != null)
		{
		    String value = extras.getString("user");
		}
		
		
	}
}