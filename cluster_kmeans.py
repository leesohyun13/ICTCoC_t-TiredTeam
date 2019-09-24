from sklearn.cluster import KMeans
import numpy as np
import csv
#load data
results = [] #empty array
path = "/Users/leesohyun/Downloads/"
with open(path + "final_data_cluster.csv") as csvfile:
    reader = csv.reader(csvfile, quoting=csv.QUOTE_NONNUMERIC) # change contents to floats
    for row in reader: # each row is a list
        results.append(row)
kmeans = KMeans(n_clusters=3, random_state=0).fit(results)
kmeans.labels_
np.savetxt(path + "k_means.csv", kmeans.labels_, delimiter=",")
