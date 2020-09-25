package com.socialsportz.Activities.User.Fragments;

import android.content.Context;
import android.os.Bundle;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.socialsportz.Models.User.EventListing;
import com.socialsportz.R;
import com.socialsportz.Utils.UlTagHandler;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;

public class EventRuleFragmentt extends Fragment {

    private Context context;
    private EventListing userFacAca;



    public EventRuleFragmentt(EventListing userFacAca) {
        this.userFacAca = userFacAca;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }


    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_event, container, false);
        context = getActivity();

        TextView note_1=rootView.findViewById(R.id.note_2);

        note_1.setText(Html.fromHtml(userFacAca.getRules(), null, new UlTagHandler()));

        return rootView;
    }





}



