package com.berhasil.apppelaporan.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.berhasil.apppelaporan.R;
import com.berhasil.apppelaporan.model.ModelKategori;
import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;

import java.util.List;

import butterknife.BindView;
import butterknife.ButterKnife;

import static com.berhasil.apppelaporan.api.RestClient.IMG_KAT_URL;

public class AdapterKategori extends RecyclerView.Adapter<AdapterKategori.KategoriViewHolder> {
    Context mContext;
    List<ModelKategori> modelKategoriList;
    private onKategoriClickListener onKategoriClickListeners;

    public AdapterKategori(Context mContext, List<ModelKategori> modelKategoriList) {
        this.mContext = mContext;
        this.modelKategoriList = modelKategoriList;
    }

    @NonNull
    @Override
    public KategoriViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_view_kategori, parent, false);
        return new KategoriViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull KategoriViewHolder holder, int position) {
        final ModelKategori getKategori = modelKategoriList.get(position);
        holder.namaKategori.setText(getKategori.getNamaKategori());
        Glide.with(mContext)
                .load(IMG_KAT_URL + getKategori.getImgKat())
                .diskCacheStrategy(DiskCacheStrategy.ALL)
                .into(holder.imgKategori);
        final int index = position;
        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (onKategoriClickListeners != null) {
                    onKategoriClickListeners.onKategoriClick(getKategori.getKd_kat(), index);
                }
            }
        });
    }

    @Override
    public int getItemCount() {
        return modelKategoriList.size();
    }

    public interface onKategoriClickListener {
        void onKategoriClick(int KategoriId, int index);
    }

    public void setOnKategoriClickListener(onKategoriClickListener onKategoriClickListener) {
        this.onKategoriClickListeners = onKategoriClickListener;
    }


    public class KategoriViewHolder extends RecyclerView.ViewHolder {
        @BindView(R.id.namaKategori)
        TextView namaKategori;
        @BindView(R.id.imgKategori)
        ImageView imgKategori;
        public KategoriViewHolder(@NonNull View itemView) {
            super(itemView);
            ButterKnife.bind(this, itemView);
        }
    }
}
