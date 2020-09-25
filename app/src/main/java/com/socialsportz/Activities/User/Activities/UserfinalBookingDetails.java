package com.socialsportz.Activities.User.Activities;

import android.content.Context;
import android.os.Bundle;
import android.widget.ImageButton;

import com.socialsportz.Models.Owner.Sport;
import com.socialsportz.R;
import com.socialsportz.Utils.SpaceItemDecoration;

import java.util.concurrent.CopyOnWriteArrayList;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

public class UserfinalBookingDetails extends AppCompatActivity {

    ImageButton ib_back;
    RecyclerView rv_book_detail;
    Context context;
    CopyOnWriteArrayList<Sport>mdata=new CopyOnWriteArrayList<>();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_userfinal_booking_details);
        context=this;
        inItView();

        findViewById(R.id.ib_back).setOnClickListener(v->{
            finish();
        });
    }

    private void inItView() {
        rv_book_detail=findViewById(R.id.rv_book_detail);
        rv_book_detail.setLayoutManager(new GridLayoutManager(context,3));
        rv_book_detail.addItemDecoration(new SpaceItemDecoration(5));
        rv_book_detail.setHasFixedSize(true);
    }

   /* private void setSportData(CopyOnWriteArrayList<Sport> mdata) {
        UserFinalDetailsselcetedSlotAdapter favSportsAdapter = new UserFinalDetailsselcetedSlotAdapter(context, mdata);
        rv_book_detail.setAdapter(favSportsAdapter);
        favSportsAdapter.notifyDataSetChanged();
    }*/
}
