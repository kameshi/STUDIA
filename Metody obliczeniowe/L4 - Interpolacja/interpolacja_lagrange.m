function[C] = interpolacja_lagrange(X,Y)
    C = 0;
    for i=1:size(X,2)
        w=1;
        for j=1:size(X,2)
            if j~=i
                w = conv(w,[1,-X(j)]/(X(i)-X(j)));
            end
        end
        C = C + Y(i) * w;
    end
end