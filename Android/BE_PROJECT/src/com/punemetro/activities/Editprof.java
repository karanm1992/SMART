package com.punemetro.activities;



import com.example.androidhive.R;

import android.app.TabActivity;
import android.content.Intent;
import android.os.Bundle;
import android.widget.TabHost;
import android.widget.TabHost.TabSpec;


@SuppressWarnings("deprecation")
public class Editprof extends TabActivity {
	public String value;
	public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.editprof);
        Bundle extras = getIntent().getExtras();
        if (extras != null)
		{
		    value = extras.getString("user");
		}
        
        TabHost tabHost = getTabHost();
        
        TabSpec prof = tabHost.newTabSpec("Profile");
        prof.setIndicator("Profile", getResources().getDrawable(R.drawable.profileimg));
        Intent profIntent = new Intent(this,Profile.class);
        profIntent.putExtra("user", value);
        prof.setContent(profIntent);
        
        TabSpec chng = tabHost.newTabSpec("Change Password");
        chng.setIndicator("Change Password", getResources().getDrawable(R.drawable.pasw));
        Intent cpIntent = new Intent(this,Chngpass.class);
        cpIntent.putExtra("user", value);
        chng.setContent(cpIntent);
        
        tabHost.addTab(prof); 
        tabHost.addTab(chng);
	}

}
