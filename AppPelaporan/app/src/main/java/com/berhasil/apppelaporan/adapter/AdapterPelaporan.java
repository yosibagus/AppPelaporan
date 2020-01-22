package com.berhasil.apppelaporan.adapter;

import android.content.Context;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.berhasil.apppelaporan.R;
import com.berhasil.apppelaporan.model.ModelPelaporan;
import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;

import java.util.List;

import butterknife.BindView;
import butterknife.ButterKnife;

import static com.berhasil.apppelaporan.api.RestClient.IMG_URL;
import static com.bumptech.glide.load.resource.drawable.DrawableTransitionOptions.withCrossFade;

public class AdapterPelaporan extends RecyclerView.Adapter<AdapterPelaporan.PelaporanViewHolder> {
    Context context;
    List<ModelPelaporan> modelPelaporanList;

    private onKategoriClickListener onKategoriClickListener;

    public AdapterPelaporan(Context context, List<ModelPelaporan> modelPelaporanList) {
        this.context = context;
        this.modelPelaporanList = modelPelaporanList;
    }

    @NonNull
    @Override
    public PelaporanViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_view_laporan, parent, false);
        return new PelaporanViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull PelaporanViewHolder holder, int position) {
        final ModelPelaporan getPelaporan = modelPelaporanList.get(position);
        Glide.with(context)
                .load(IMG_URL + getPelaporan.getFotoLap())
                .thumbnail(0.5f)
                .transition(withCrossFade())
                .centerCrop()
                .into(holder.imgLaporan);
        holder.locasiLaporan.setText(getPelaporan.getLokasi());
        holder.namaKategori.setText(getPelaporan.getKd_kat());
        holder.tglLaporan.setText(getPelaporan.getTgl_lap());
        if (getPelaporan.getStatus().equalsIgnoreCase("pending")) {
            holder.statusLaporan.setTextColor(Color.BLACK);
        } else if(getPelaporan.getStatus().equalsIgnoreCase("diterima")){
            holder.statusLaporan.setTextColor(Color.parseColor("#009605"));
        } else if(getPelaporan.getStatus().equalsIgnoreCase("dalam proses")) {
            holder.statusLaporan.setTextColor(Color.parseColor("#FF7F00"));
        } else if (getPelaporan.getStatus().equalsIgnoreCase("selesai")) {
            holder.statusLaporan.setTextColor(Color.parseColor("#2196F3"));
        } else {
            holder.statusLaporan.setTextColor(Color.parseColor("#FF0000"));
        }
        holder.statusLaporan.setText(getPelaporan.getStatus());

        final int index = position;
        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (onKategoriClickListener != null) {
                    onKategoriClickListener.onKategoriClick(getPelaporan.getKd_lap(), index);
                }
            }
        });
    }

    @Override
    public int getItemCount() {
        return modelPelaporanList.size();
    }

    public interface onKategoriClickListener {
        void onKategoriClick(int PelaporanId, int index);
    }

    public void setOnKategoriClickListener (onKategoriClickListener onKategoriClickListeners){
        this.onKategoriClickListener = onKategoriClickListeners;
    }

    public class PelaporanViewHolder extends RecyclerView.ViewHolder {
        @BindView(R.id.img_lap)
        ImageView imgLaporan;
        @BindView(R.id.nm_kategori)
        TextView namaKategori;
        @BindView(R.id.lokasi_laporan)
        TextView locasiLaporan;
        @BindView(R.id.tgl_laporan)
        TextView tglLaporan;
        @BindView(R.id.status_laporan)
        TextView statusLaporan;
        public PelaporanViewHolder(@NonNull View itemView) {
            super(itemView);
            ButterKnife.bind(this, itemView);
        }
    }
}
