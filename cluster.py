import numpy as np
import csv
from sklearn.cluster import AgglomerativeClustering

#load data
results = [] #empty array
path = "/Users/leesohyun/Downloads/"
with open(path + "final_data_cluster.csv") as csvfile:
    reader = csv.reader(csvfile, quoting=csv.QUOTE_NONNUMERIC) # change contents to floats
    for row in reader: # each row is a list
        results.append(row)

#n_clusters=3 (분류 : 가장 위험, 위험, 경고 지역)
#계산 방식 : euclidean(거리 계산법)
#linkage='ward' : 기본값, 모든 클러스터 내의 분산을 가장 작게 증가시키는 두 클러스터를 합침, 크기가 비교적 비슷한 클러스터가 만들어짐
model = AgglomerativeClustering(n_clusters=3, affinity='euclidean', linkage='ward')
model.fit(results)
#모델 클러스터 결과를 labels에 저장
labels = model.labels_

#array to csv file
model.labels_
np.savetxt(path + "cluster.csv", model.labels_, delimiter=",")
