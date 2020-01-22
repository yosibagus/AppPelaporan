package com.berhasil.apppelaporan.response;

import com.berhasil.apppelaporan.model.ModelPelaporan;
import com.google.gson.annotations.SerializedName;

import java.util.List;

public class ResponsePelaporan {

    @SerializedName("pelaporan") private List<ModelPelaporan> AllPelaporan;
    public List<ModelPelaporan> getAllPelaporan() {
        return AllPelaporan;
    }

}
