package com.example.sipapp_project;

import android.app.ActionBar;
import android.app.Activity;
import android.os.Bundle;

public class TermsActivity extends Activity {
	@Override
	protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_terms);
        
        ActionBar actionBar = getActionBar();
        actionBar.setDisplayHomeAsUpEnabled(true);
        
	}
	
}
